let editor;
var inputs = $("#input");
var myData;
var language;
window.onload = function () {
    language = 'java';
    nodes = document.querySelectorAll('#editor');
    for (let i = 0; i < nodes.length; i++) {
        editor = CodeMirror.fromTextArea(nodes[i], {
            mode: "text/x-java",
            lineNumbers: true,
        });
        editor.setSize("600", "500");
    }
}
nodes = document.querySelectorAll('#editor');

function onChangeLanguage() {
    var x = document.getElementById("language").value;
    if (x === 'java') {
        language = 'java';
        editor.setOption("mode", "text/x-java");
    } else {
        language = 'php';
        editor.setOption("mode", "php");
    }

}

$("#run").on("click", function () {



})

var buttons = document.getElementsByName("run");

// Define the onclick function
function buttonClickHandler() {
    // Gets code and unit test
    const prevSibling = this.parentNode;
    let editor_acual = prevSibling.querySelector(".CodeMirror").CodeMirror;
    let code = editor_acual.getValue();
    const parentNode = prevSibling.parentNode;
    let myData = parentNode.querySelector("#dom-target").textContent;

    $.ajax({
        url: "server_java.php",
        method: "POST",
        data: {
            code: code,
            input: myData
        },
        success: function (response) {
            const redLines = []
            const greenLines = []
            const xhr1 = new XMLHttpRequest();
            xhr1.open('GET', `./files/java/reports/default/${response}.java.html`);
            xhr1.onload = function () {
                if (xhr1.status === 200) {
                    parser = new DOMParser();
                    var doc = parser.parseFromString(xhr1.responseText, "text/html");
                    const collectionGreen = doc.getElementsByClassName("fc");
                    const collectionRed = doc.getElementsByClassName("nc");
                    for (let i = 0; i < collectionGreen.length; i++) {
                        greenLines.push(parseInt(collectionGreen[i].id.split("L")[1]))
                    }
                    for (let i = 0; i < collectionRed.length; i++) {
                        redLines.push(parseInt(collectionRed[i].id.split("L")[1]))
                    }
                    for (let i = 0; i < redLines.length; i++) {
                        range = { start: { line: redLines[i] - 1, ch: 0 }, end: { line: redLines[i], ch: 0 }, style: "background-color: #FFA09F;" },
                            editor_acual.markText(range.start, range.end, { css: range.style });
                    }
                    for (let i = 0; i < greenLines.length; i++) {
                        range = { start: { line: greenLines[i] - 1, ch: 0 }, end: { line: greenLines[i], ch: 0 }, style: "background-color: #AFE1AF;" },
                            editor_acual.markText(range.start, range.end, { css: range.style });
                    }
                } else {
                    console.error('Error loading file: ' + xhr1.statusText);
                }
            };
            xhr1.onerror = function () {
                console.error('Network error while loading file');
            };
            xhr1.send();

            //Now we get information about tests
            const xhr2 = new XMLHttpRequest();
            xhr2.open('GET', './files/java/reports/TEST-junit-jupiter.xml');
            xhr2.onload = function () {
                if (xhr2.status === 200) {
                    parser = new DOMParser();
                    xmlDoc = parser.parseFromString(xhr2.responseText, "text/xml");
                    const collectionGreen = xmlDoc.getElementsByTagName("testcase");
                    const mensajesOutput = [];
                    for (let i = 0; i < collectionGreen.length; i++) {
                        const testcase = collectionGreen[i].getAttribute("name");
                        const failure = collectionGreen[i].getElementsByTagName("failure")[0];
                        const error = collectionGreen[i].getElementsByTagName("error")[0];
                        if (failure) {
                            const msg = failure.getAttribute("message");
                            if (msg === 'null') {
                                msg = failure.getAttribute("type");
                            }
                            mensajesOutput.push(` <b style="color:red;">Failure</b> ${testcase + ' '} <b>${msg}</b>`);
                        } else if (error) {
                            const msg = error.getAttribute("message");
                            mensajesOutput.push(` <b style="color:red;">Error</b> ${testcase + ' '} <b>${msg}</b>`);
                        }
                        else {
                            mensajesOutput.push(`<b style="color:green;">OK</b> ${testcase + ' '}`);
                        }
                    }

                    const stringList = parentNode.querySelector("[name=string-list]");
                    stringList.innerHTML = '';
                    mensajesOutput.forEach((str) => {
                        const li = document.createElement('li');
                        li.innerHTML = str;
                        stringList.appendChild(li);
                    });

                }
                else {
                    console.error('Error loading file: ' + xhr2.statusText);
                }
            };
            xhr2.onerror = function () {
                console.error('Network error while loading file');
            };
            xhr2.send();

            //legacy
            const xhrRetry = new XMLHttpRequest();
            xhrRetry.open('GET', `./files/java/reports/TEST-junit-vintage.xml`);
            xhrRetry.onload = function () {
                if (xhrRetry.status === 200) {
                    parser = new DOMParser();
                    xmlDoc = parser.parseFromString(xhrRetry.responseText, "text/xml");
                    const collectionGreen = xmlDoc.getElementsByTagName("testcase");
                    const mensajesOutput = [];
                    for (let i = 0; i < collectionGreen.length; i++) {
                        const testcase = collectionGreen[i].getAttribute("name");
                        const failure = collectionGreen[i].getElementsByTagName("failure")[0];
                        const error = collectionGreen[i].getElementsByTagName("error")[0];
                        if (failure) {
                            let msg = failure.getAttribute("message");
                            if (msg == null) {
                                msg = failure.getAttribute("type");
                            }
                            mensajesOutput.push(` <b style="color:red;">Failure</b> ${testcase + ' '} <b>${msg}</b>`);
                        } else if (error) {
                            const msg = error.getAttribute("message");
                            mensajesOutput.push(` <b style="color:red;">Error</b> ${testcase + ' '} <b>${msg}</b>`);
                        }
                        else {
                            mensajesOutput.push(`<b style="color:green;">OK</b> ${testcase + ' '}`);
                        }
                    }

                    const stringList = parentNode.querySelector("[name=string-list]");
                    // stringList.innerHTML = '';
                    mensajesOutput.forEach((str) => {
                        console.log(str);
                        console.log('1');
                        const li = document.createElement('li');
                        li.innerHTML = str;
                        stringList.appendChild(li);
                        console.log(stringList);
                    });
                } else {
                    console.log("Error retrieving file 2");
                }
            };
            xhrRetry.send();

        },
    })

}

// Attach the onclick function to each button
for (var i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener("click", buttonClickHandler);
}