# Prerequisites

## First problem: Direct connection

#### Attack

With the current topology, an attacker can just connect to the vault and open it using the following command:

```bash
echo create | nc 10.10.1.231 9999
```

#### Mitigation

To mitigate the risk of direct connection to the vault, you can add network access control on the router. This can be achieved by entering the following command on the router:

```bash
iptables -A FORWARD ! -s 192.168.5.107 -d 10.10.1.231 -p tcp --dport 9999 -j DROP
```

## Second problem: Race Condition Exploitation

#### Attack

In the given scenario, the attacker can exploit a race condition to gain unauthorized access to the vault. Here's how the attack can be executed:

1. The attacker initiates the attack from their real IP address, which is `192.168.5.108`.
2. The attacker spoofs their IP address as `192.168.5.107`, impersonating another legitimate device on the network.
3. The attacker sends a SYN packet (TCP synchronization) to the Raspberry Pi, indicating the desire to establish a connection.
4. The Raspberry Pi responds with a SYN/ACK packet (synchronization acknowledgment) to the spoofed IP address `192.168.5.107`, believing it to be the legitimate device.
5. Before the real `192.168.5.107` can respond with an RST (reset) packet to terminate the connection, the attacker quickly sends an ACK (acknowledgment) and PSH/ACK (push acknowledgment) within a single packet.
6. The Raspberry Pi, still assuming the spoofed IP address `192.168.5.107` is legitimate, receives the combined ACK and PSH/ACK packet and interprets it as a valid command to open the door of the vault.

## Disclaimer

The attack on fingerprint theft is presented for educational purposes only. It is important to understand that fingerprint theft is illegal and unethical. This project aims to raise awareness about the vulnerabilities associated with fingerprint security and promote better security practices.