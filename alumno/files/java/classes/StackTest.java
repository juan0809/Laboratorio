
            import org.junit.Test;
import static org.junit.Assert.*;

public class StackTest {
    @Test
    public void testIsEmpty() {
        Stack stack = new Stack(5);
        assertTrue(stack.isEmpty());
        stack.push(1);
        assertFalse(stack.isEmpty());
    }

    @Test
    public void testIsFull() {
        Stack stack = new Stack(2);
        assertFalse(stack.isFull());
        stack.push(1);
        stack.push(2);
        assertTrue(stack.isFull());
    }

    @Test
    public void testPushAndPop() {
        Stack stack = new Stack(3);
        stack.push(1);
        stack.push(2);
        stack.push(3);
        assertEquals(3, stack.pop());
        assertEquals(2, stack.pop());
        assertEquals(1, stack.pop());
        assertTrue(stack.isEmpty());
    }

    @Test
    public void testPeek() {
        Stack stack = new Stack(3);
        stack.push(1);
        stack.push(2);
        stack.push(3);
        assertEquals(3, stack.peek());
        stack.pop();
        assertEquals(2, stack.peek());
    }
}
        