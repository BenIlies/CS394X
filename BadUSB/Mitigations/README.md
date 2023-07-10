# Open Vault Executable

The `executable-open-vault.py` script is used to generate an executable that can be whitelisted by the client's firewall. This executable will be the only file allowed to establish a connection with the Raspberry Pi server. Follow the instructions below to download and install Miniconda, create the Conda environment, and generate the executable.

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

   - With the "open-vault-env" environment activated, execute the following command to install PyInstaller using pip:
     ```
     python -m pip install pyinstaller
     ```

5. Generate the Executable:

   - Place the `executable-open-vault.py` script in a directory of your choice.
   - Navigate to the directory containing the script in the command prompt or Anaconda Prompt.
   - Run the following command to generate the executable:
     ```
     python -m PyInstaller --onefile executable-open-vault.py
     ```
   - PyInstaller will create a standalone executable file in a "dist" directory within the current directory.

6. Whitelist the Executable:

    - [ ] **To be updated:** Provide steps to whitelist the executable.

## TLS Encryption with Passphrase

The best mitigation found for this attack is to use Transport Layer Security (TLS) encryption with passphrase-protected keys. This adds an additional layer of security by encrypting the TLS keys used for communication with the Raspberry Pi server. To implement this mitigation, follow the instructions provided in the `Prerequisites` folder and refer to the specific guidelines mentioned in the README file.
