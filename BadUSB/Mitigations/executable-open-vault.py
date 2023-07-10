import socket

# Set the hostname and port number of the rasberry pi server
HOST = "server.cs394x.com"
PORT = 9999

# Create a socket object
with socket.socket(socket.AF_INET, socket.SOCK_STREAM) as s:
    # Connect to the server
    s.connect((HOST, PORT))
    
    # Send a message to the server
    s.sendall(b"echo create")