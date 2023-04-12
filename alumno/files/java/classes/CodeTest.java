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
    }

    @Test
    public void testNumero_mayor_caso2() {        
        int a = 5;
        int b = 3;
        int c = 4;
        MiClase instance = new MiClase();
        int expResult = 5;
        int result = instance.numero_mayor(a, b, c);
        assertEquals(expResult, result);        
    }
    
    @Test
    public void testNumero_mayor_caso3() {        
        int a = 5;
        int b = 7;
        int c = 6;
        MiClase instance = new MiClase();
        int expResult = 7;
        int result = instance.numero_mayor(a, b, c);
        assertEquals(expResult, result);        
    }
    
    @Test
    public void testNumero_mayor_caso4() {        
        int a = 5;
        int b = 7;
        int c = 9;
        MiClase instance = new MiClase();
        int expResult = 9;
        int result = instance.numero_mayor(a, b, c);
        assertEquals(expResult, result);        
    }        }