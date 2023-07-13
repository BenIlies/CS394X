# Prerequisites

## First problem: Direct connection

### Attack

With the current topology, an attacker can just connect to the vault and open it using the following command:

```bash
echo create | nc 10.10.1.231 9999
```

### Mitigation

To mitigate the risk of direct connection to the vault, you can add network access control on the router. This can be achieved by entering the following command on the router:

```bash
iptables -A FORWARD ! -s 192.168.5.107 -d 10.10.1.231 -p tcp --dport 9999 -j DROP
```

## Second problem: Race Condition Exploitation

### Attack

In the given scenario, the attacker can exploit a race condition to gain unauthorized access to the vault. Here's how the attack can be executed:

1. The attacker initiates the attack from their real IP address, which is `192.168.5.108`.
2. The attacker spoofs their IP address as `192.168.5.107`, impersonating another legitimate device on the network.
3. The attacker sends a SYN packet (TCP synchronization) to the Raspberry Pi, indicating the desire to establish a connection.
4. The Raspberry Pi responds with a SYN/ACK packet (synchronization acknowledgment) to the spoofed IP address `192.168.5.107`, believing it to be the legitimate device.
5. Before the real `192.168.5.107` can respond with an RST (reset) packet to terminate the connection, the attacker quickly sends an ACK (acknowledgment) and PSH/ACK (push acknowledgment) within a single packet.
6. The Raspberry Pi, still assuming the spoofed IP address `192.168.5.107` is legitimate, receives the combined ACK and PSH/ACK packet and interprets it as a valid command to open the door of the vault.

## Second Problem: Race Condition Exploitation

### Attack

The attacker initiates the attack from their real IP address (`192.168.5.108`) and spoofs their IP address as `192.168.5.107`, impersonating another legitimate device. By exploiting a race condition, the attacker sends a SYN packet, receives a SYN/ACK packet from the Raspberry Pi (server), and quickly sends an ACK and PSH/ACK packet to open the door of the vault.

### Mitigation

To effectively mitigate race condition exploitation and completely eliminate the risk of unauthorized access, the following comprehensive mitigation strategies should be implemented:

1. **Implement Transport Layer Security (TLS) with Dual Authentication:**

   - On the Raspberry Pi (server), generate the root certificate (with encrypted keys) and certificate signing request:
     ```bash
     sudo openssl genpkey -algorithm RSA -out 394X-CA.key -aes256
     sudo openssl req -new -key 394X-CA.key -out 394X-CA.csr
     ```

   - Generate the root certificate on the Raspberry Pi (server):
     ```bash
     sudo openssl x509 -req -days 3650 -in 394X-CA.csr -signkey 394X-CA.key -out 394X-CA.crt
     ```

   - On the Raspberry Pi (server), create encrypted private/public key pairs for the server:
     ```bash
     sudo openssl genpkey -algorithm RSA -out server.key -aes256
     ```

   - Create the certificate for the server on the Raspberry Pi (server):
     ```bash
     sudo openssl req -new -sha256 -subj "/CN=server.cs394x.com" -key server.key -out server.csr
     sudo sh -c 'echo "subjectAltName=DNS:server.cs394x.com" > server-extfile.cnf'
     sudo openssl x509 -req -sha256 -days 365 -in server.csr -CA 394X-CA.crt -CAkey 394X-CA.key -out server.crt -extfile server-extfile.cnf -CAcreateserial
     ```

2. **Modify the `/etc/hosts` File:**

   On the Raspberry Pi (server), modify the `/etc/hosts` file to include the following entry:


   ```
   x.x.x.x client.cs394x.com
   ```

   On the client device, modify the `/etc/hosts` file to include the following entry:

   ```
   y.y.y.y server.cs394x.com
   ```

   Replace `y.y.y.y` with the actual IP address of the Raspberry Pi (server) (`10.10.1.231` in this scenario), and replace `x.x.x.x` with the actual IP address of the client device (`192.168.5.107` in this scenario)

3. **Generate Client Certificate:**

- On the client device, generate an encrypted private/public key pair for the client:
  ```bash
  openssl genpkey -algorithm RSA -out client.key -aes256
  ```

- Create a certificate signing request (CSR) for the client on the client device:
  ```bash
  openssl req -new -sha256 -subj "/CN=client.cs394x.com" -key client.key -out client.csr
  ```

- Transfer the client CSR (`client.csr`) securely to the Raspberry Pi (server).

- On the Raspberry Pi (server), sign the client CSR with the root certificate to generate a client certificate:
  ```bash
  sudo openssl x509 -req -sha256 -days 365 -in client.csr -CA 394X-CA.crt -CAkey 394X-CA.key -out client.crt -CAcreateserial
  ```

- Transfer the generated client certificate (`client.crt`) securely to the client device.

4. **Implementation Scripts:**

- On the Raspberry Pi (server), run the provided `tls-server.py` script:
  - This script creates a TCP socket, binds it to the server IP and port, and listens for incoming connections.
  - It wraps the socket with SSL/TLS using the server certificate (`server.crt`) and private key (`server.key`).
  - The script verifies the client certificates against the root certificate (`394X-CA.crt`).
  - By running this script, the Raspberry Pi (server) only accepts connections from clients that present valid client certificates signed by the trusted root certificate.

- On the client device, run the provided `tls-client.py` script:
  - This script creates a TCP socket and wraps it with SSL/TLS using the client certificate (`client.crt`) and private key (`client.key`).
  - It connects to the server (`server.cs394x.com`) using the server IP and port.
  - By running this script, the client securely communicates with the Raspberry Pi (server), ensuring the authenticity and integrity of the connection.

By implementing these comprehensive mitigation strategies, the system can effectively eliminate the race condition exploitation, providing robust protection and enhancing the overall security of the vault.