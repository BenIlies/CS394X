# Zeek

Zeek is a powerful network analysis framework that functions as an Intrusion Detection System (IDS), enabling the monitoring, analysis, and tracking of network traffic in real-time. It provides a flexible and scriptable platform for network security monitoring, network forensics, and network troubleshooting.

## Passive Network Monitoring

Zeek, formerly known as Bro, operates on a passive monitoring model, sniffing network traffic passively without actively injecting packets. It captures and processes network packets at high speed while extracting meaningful information from the captured data. Zeek allows you to write custom scripts using the Zeek scripting language to extract specific network events, detect network anomalies, and generate detailed logs for further analysis.

## Vault Monitoring with Zeek

In the context of the `vault.zeek` script, Zeek is utilized as an IDS to track TCP packets associated with the remote vault located at IP address `10.10.1.231`. The script captures TCP packets and logs specific packet information when a successful connection with the vault is established.

### Module Definition

The `vault.zeek` script defines a module named `vault`. This module contains the definition of a log ID and a record type called `Info`. The `Info` record stores various details of each captured packet, such as IP addresses, ports, TCP flags, sequence and acknowledgment numbers, payload length, and payload data.

### Log Stream Initialization

During Zeek initialization, the script sets up an initialization event, `zeek_init()`, which creates a log stream named `vault.log` with columns matching the `Info` record. This log stream serves as a repository for storing the packet information for further analysis.

### Handling TCP Packets

Another event, `tcp_packet`, is defined to handle each captured TCP packet. This event checks if the packet is originating from the specified IP address and port of the vault. If the conditions are met, the packet information is populated into a new instance of the `Info` record. The record is then written to the `vault.log` log stream.

## Getting Started

To start the Zeek program and run the `vault.zeek` script:

1. Install Zeek on your system. (Refer to the Zeek documentation for installation instructions specific to your platform.)

2. Copy the `vault.zeek` script to a suitable directory.

3. Open a terminal or command prompt and navigate to the directory where the `vault.zeek` script is located.

4. Execute the following command to start Zeek and load the `vault.zeek` script:

    ```bash
    zeek -i <interface> vault.zeek
    ```

Replace `<interface>` with the network interface you want Zeek to monitor.

5. Zeek will start capturing and analyzing network traffic related to the remote vault. The captured packet information will be logged to the `vault.log` file in the same directory.

6. Monitor the `vault.log` file for relevant packet information and analyze it as needed.

## Benefits of Zeek as an IDS

By leveraging Zeek as an IDS, the `vault.zeek` script enables tracking of events related to the vault and attempts to access it. Although it does not prevent unauthorized access directly, it provides valuable insights and evidence to investigate and analyze any security incidents or breaches that may occur.