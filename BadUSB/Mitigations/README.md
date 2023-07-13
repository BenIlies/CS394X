
# BadUSB mitigation methods

It is important to note that there is no perfect mitigation for a BadUSB attack. However, in the case where we want to open the door of a vault remotely, there are several mitigation techniques that can be implemented to enhance security. Two such techniques are Multi-Factor Authentication (MFA) and TLS encryption with a passphrase-protected key.

## Multi-Factor Authentication (MFA)

We can implement MFA so that when the badUSB triggers the connection, the user receives a 6-digit password on his phone (since we are separated from the internet, we use the LCD of the vault) that he will input to successfully open the door. More information can be found in the `fix-server-mfa.py` file.

   <div align="center">
      <img src="https://github.com/BenIlies/CS394X/raw/main/BadUSB/Mitigations/remote-access-mfa.PNG" alt="Remote Access MFA">
   </div>

   > Note: The specific factors used in the MFA setup can vary but typically involve a combination of something the user knows (such as a password or PIN), something the user has (such as a smart card or token), or something the user is (biometric attributes other than fingerprints).

   **Important:** Please note that the `fix-server-mfa.py` implementation is designed for Python 2.7. If you are using a different version of Python, ensure compatibility or consider adapting the code accordingly.



## TLS Encryption with Passphrase

Another good mitigation found for this attack is to use Transport Layer Security (TLS) encryption with passphrase-protected keys. This adds an additional layer of security by encrypting the TLS keys used for communication with the Raspberry Pi server. To implement this mitigation, follow the instructions provided in the `Prerequisites` folder and refer to the specific guidelines mentioned in the README file.
