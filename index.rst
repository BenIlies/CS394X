CS394X Attacks and Mitigations
==============================

Project Description
-------------------

The CS394X Attacks and Mitigations project focuses on discovering vulnerabilities in the OT (Operational Technology) world and providing effective mitigations. The goal of the project is not only to explore and understand OT vulnerabilities but also to emphasize the importance of implementing robust security measures to protect against these attacks.

Threat Assumptions
------------------

The following assumptions have been made regarding the threats:

- The attacker can have access to the packets being forwarded without being able to interrupt the communication (Network tap without Denial of Service).
- The attacker is able to spoof its IP address.
- The firewall and the Raspberry Pi are considered totally trustworthy.
- The attacker knows the IP address of the client and the server. They also know the process that is running, including the port and command that would unlock the vault.

Topology
--------

::

                        +----------------------------------------------------+
                        |                      Client                        |
                        |   VM (Windows 7) - Vmnet0: 192.168.5.107           |
                        |   Host (Windows 10) - en0: 192.168.5.106           |
                        |                                                    |
                        +----------------------------------------------------+
                                            |
                                            |
                        +----------------------------------------------------+
                        |                      Router                        |
                        |   en0: 192.168.5.1 (Client side)                   |
                        |   en1: 10.10.1.1 (Server side)                     |
                        |                                                    |
                        +----------------------------------------------------+
                                            |
                                            |
                        +----------------------------------------------------+
                        |                      Server                        |
                        |   Raspberry Pi - en0: 10.10.1.231                  |
                        |                                                    |
                        |   Processes:                                       |
                        |   - Port 9999 (Listening)                          |
                        |   - Port 51130 (Listening)                         |
                        |                                                    |
                        |   Arduino Controller (Connected)                   |
                        |   (Controls the vault door)                        |
                        +----------------------------------------------------+


Attack Scenarios
----------------

Prerequisites
--------------
* :doc:`Prerequisites/README <Prerequisites/README>`

Attacks
-------
* KGL-win
    * :doc:`KGL-win/Attacks/README <KGL-win/Attacks/README>`
* Vulnerable-Website
    * Broken Access Control
        * :doc:`Vulnerable-Website/Attacks/Broken-Access-Control/README <Vulnerable-Website/Attacks/Broken-Access-Control/README>`
    * SQL Injection
        * :doc:`Vulnerable-Website/Attacks/SQL-Injection/README <Vulnerable-Website/Attacks/SQL-Injection/README>`
* BadUSB
    * :doc:`BadUSB/Attacks/README <BadUSB/Attacks/README>`
* Stolen-Fingerprint
    * :doc:`Stolen-Fingerprint/Attacks/README <Stolen-Fingerprint/Attacks/README>`

Mitigations
-----------
* KGL-win
    * :doc:`KGL-win/Mitigations/README <KGL-win/Mitigations/README>`
* Vulnerable-Website
    * :doc:`Vulnerable-Website/Mitigations/README <Vulnerable-Website/Mitigations/README>`
* BadUSB
    * :doc:`BadUSB/Mitigations/README <BadUSB/Mitigations/README>`
* Stolen-Fingerprint
    * :doc:`Stolen-Fingerprint/Mitigations/README <Stolen-Fingerprint/Mitigations/README>`

Zeek Network Monitoring
-----------------------
* :doc:`Zeek/README <Zeek/README>`


Conclusion
----------

Through this project, we have explored various OT vulnerabilities and emphasized the importance of implementing effective mitigations. Some of the recommended mitigation methods include:

- Access control lists
- End-to-end encryption with mutual authentication, certificate pinning, and encrypted keys
- Intrusion Detection Systems (IDS)
- Multi-factor authentication
- Regular use of pentesting tools to test web server security
- Exercise caution when opening unfamiliar files, both from email attachments and internet downloads
- Avoid connecting unknown devices to your computer
- Implement the principle of least privilege for applications

By implementing these mitigations, we can enhance the security posture of OT systems and protect them from potential attacks.

Disclaimer
----------

This project is for educational purposes only. We do not support or encourage any illegal or unethical activities.
