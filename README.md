# CS394X Attacks and Mitigations

## Project Description

The CS394X Attacks and Mitigations project focuses on discovering vulnerabilities in the OT (Operational Technology) world and providing effective mitigations. The goal of the project is not only to explore and understand OT vulnerabilities but also to emphasize the importance of implementing robust security measures to protect against these attacks.

## Threat Assumptions

The following assumptions have been made regarding the threats:

- The attacker can have access to the packets being forwarded without being able to interrupt the communication (Network tap without Denial of Service).
- The attacker is able to spoof its IP address.
- The firewall and the Raspberry Pi are considered totally trustworthy.
- The attacker knows the IP address of the client and the server. They also know the process that is running, including the port and command that would unlock the vault.

## Topology

```
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
```


Topology Description:

- **Client**: It consists of a virtual machine (guest OS) running Windows 7 with IP address 192.168.5.107 on interface Vmnet0, and the host OS (Windows) with IP address 192.168.5.106 on interface en0. The client is connected to the router via the host OS.

- **Router**: It connects the client and the server with two interfaces, en0 and en1. The client-side interface (en0) has an IP address of 192.168.5.1, and the server-side interface (en1) has an IP address of 10.10.1.1.

- **Server (Raspberry Pi within the vault)**: The server is connected to the router with an IP address of 10.10.1.231 on interface en0. It runs two processes that are listening on ports 9999 and 51130. It's linked to an Arduino controller that can open the vault door.


## Attack Scenarios

#### Prerequisites

The project includes a set of prerequisites in the [Prerequisites](Prerequisites) folder.

#### Attacks

The project addresses the following attack scenarios:

- [KGL-win](KGL-win/Attacks)
- [Vulnerable website](Vulnerable-Website)
    - [SQL Injection](Vulnerable-Website/Attacks/SQL-Injection)
    - [Broken access control](Vulnerable-Website/Attacks/Broken-Access-Control)
- [BadUSB](BadUSB/Attacks)
- [Stolen Fingerprint](Stolen-Fingerprint/Attacks)

#### Mitigations

To mitigate the identified threats, refer to the following folders:

- [KGL-win Mitigations](KGL-win/Mitigations)
- [Vulnerable website Mitigations](Vulnerable-Website/Mitigations)
- [BadUSB Mitigations](BadUSB/Mitigations)
- [Stolen Fingerprint Mitigations](Stolen-Fingerprint/Mitigations)

For specific attacks related to each scenario, refer to the respective "Attacks" folders within each scenario folder.

#### Zeek Network Monitoring

In addition to the above attack scenarios and mitigations, the project utilizes Zeek as a network monitoring tool. Zeek (formerly known as Bro) is a powerful network analysis framework that operates as an Intrusion Detection System (IDS). It enables the monitoring, analysis, and tracking of network traffic in real-time.

For more details on how Zeek is utilized in this project, refer to the [Zeek](Zeek) folder.

## Conclusion

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

## Disclaimer

This project is for educational purposes only. We do not support or encourage any illegal or unethical activities.