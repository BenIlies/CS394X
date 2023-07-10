==============
CS394X Attacks and Mitigations
==============

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

Attack Scenarios
----------------

The project addresses the following attack scenarios:

- KGL-win (`KGL-win <KGL-win/index.rst>`)
- Vulnerable website (`Vulnerable website <Vulnerable-Website/index.rst>`)
    - SQL INJECTION (`SQL INJECTION <Vulnerable-Website/Attacks/SQL-INJECTION/index.rst>`)
    - Broken access control (`Broken access control <Vulnerable-Website/Attacks/Broken-Access-Control/index.rst>`)
- BadUSB (`BadUSB <BadUSB/index.rst>`)
- Stolen Fingerprint (`Stolen Fingerprint <Stolen-Fingerprint/index.rst>`)

Mitigations
-----------

To mitigate the identified threats, refer to the following folders:

- KGL-win Mitigations (`KGL-win Mitigations <KGL-win/Mitigations/index.rst>`)
- Vulnerable website Mitigations (`Vulnerable website Mitigations <Vulnerable-Website/Mitigations/index.rst>`)
- BadUSB Mitigations (`BadUSB Mitigations <BadUSB/Mitigations/index.rst>`)
- Stolen Fingerprint Mitigations (`Stolen Fingerprint Mitigations <Stolen-Fingerprint/Mitigations/index.rst>`)

For specific attacks related to each scenario, refer to the respective "Attacks" folders within each scenario folder.

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
