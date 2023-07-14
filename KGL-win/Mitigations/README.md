# Generating Firewall-Whitelisted Executables to Open the Vault

By following the steps below, you will create a trusted executable file using the `executable-open-vault.py` script, which can be whitelisted by the client's firewall. This ensures that only the trusted application is allowed to establish a connection, enhancing security and mitigating potential attacks.

## Instructions

1. Download and Install Miniconda:
   - Download Miniconda from the official Miniconda website at [https://docs.conda.io/en/latest/miniconda.html](https://docs.conda.io/en/latest/miniconda.html).
   - Follow the installation instructions provided on the website to install Miniconda on the client's machine.

2. Create a Conda Environment:
   - Open the command prompt or Anaconda Prompt on the client's machine.
   - Execute the following command to create a new Conda environment named "open-vault-env" with Anaconda and Python 3.7:
     ```
     conda create -n open-vault-env anaconda python=3.7
     ```
   - Confirm the installation by selecting "y" when prompted.

3. Activate the Conda Environment:
   - Run the following command to activate the "open-vault-env" environment:
     ```
     conda activate open-vault-env
     ```

4. Install PyInstaller:
   - With the "open-vault-env" environment activated, install PyInstaller using pip with this command:
     ```
     python -m pip install pyinstaller
     ```

5. Generate the Executable:
   - Place the `executable-open-vault.py` script in a directory of your choice.
   - Navigate to the directory containing the script in the command prompt or Anaconda Prompt.
   - Execute the following command to generate the executable:
     ```
     python -m PyInstaller --onefile executable-open-vault.py
     ```
   - PyInstaller will create a standalone executable file in a "dist" directory within the current directory.

6. Whitelist the Executable:
   - Configure the Windows Firewall to only allow the trusted Open Vault executable (generated using `executable-open-vault.py`) to establish a connection with the server. Follow these steps:
     - Enable the Windows Firewall in the Windows Firewall settings.

   <div align="center">
      <img src="https://github.com/BenIlies/CS394X/raw/main/KGL-win/Mitigations/firewall-enabling.PNG" alt="Enabling firewall">
   </div>

   - Access the advanced settings and verify the rules for Domain, Public, and Private profiles:
      - Outbound connections that do not match are blocked.
      - Inbound connections that do not match are blocked.
   - Create a new rule by clicking on "Outbound Rules" > "Actions" > "New rule."
   - Select "Program" > "Next" in the prompt.
   - Add the path to the Open Vault executable located in the "Program Files" directory. Click "Next."
   - In the "Action" step, select "Allow the connection" > "Next."
   - In the "Profile" step, select all three options: Domain, Public, and Private.
   - Provide a name for the rule and complete the setup.
   - Open the properties of the newly created rule and select the "Scope" tab.
   - Click the "Add" button under the "Remote IP addresses" section and enter the server's IP address (e.g., 10.10.1.231).
   - Switch to the "Protocols and Ports" tab.
   - Select "TCP" as the protocol and add "9999" as the port.
   - Apply the changes and close the rule properties.

   <div align="center">
      <img src="https://github.com/BenIlies/CS394X/raw/main/KGL-win/Mitigations/executable-whitelisted.PNG" alt="Executable whitelisted">
   </div>

   Ensure that the rule you created is enabled. This configuration will restrict every application from communicating with the server (IP: 10.10.1.231, Port: 9999) except for the trusted Open Vault executable. By implementing these measures, you enhance security by limiting direct connections and mitigating potential attacks.

**Note:** These instructions focus on network-level security and firewall configuration. Techniques like ASLR and stack canaries are important for mitigating buffer overflow attacks but are beyond the scope of this guide.