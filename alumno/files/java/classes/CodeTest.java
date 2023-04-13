import org.junit.jupiter.api.Assertions;
    import org.junit.jupiter.api.Test;
    import static org.junit.Assert.assertEquals;
    public class CodeTest {
          @Test
    public void testNumero_mayor_caso1() {        
        int a = 5;
        int b = 3;
        int c = 7;
        MiClase instance = new MiClase();
        int expResult = 7;
        int result = instance.numero_mayor(a, b, c);
        assertEquals(expResult, result);        
    }        }