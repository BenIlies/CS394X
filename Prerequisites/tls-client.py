import socket
import ssl

# Server IP address and port
server_ip = 'server.cs394x.com'
server_port = 10000

# Paths to client key, certificate, and CA certificate
client_key = 'client.key'
client_cert = 'client.crt'
ca_cert = '394X-CA.crt'

# Create a TCP socket
sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)

# Wrap the socket with SSL/TLS
context = ssl.create_default_context(ssl.Purpose.SERVER_AUTH)
context.load_cert_chain(certfile=client_cert, keyfile=client_key)
context.load_verify_locations(cafile=ca_cert)
context.verify_mode = ssl.CERT_REQUIRED

# Connect to the server
ssl_sock = context.wrap_socket(sock, server_hostname=server_ip)
ssl_sock.connect((server_ip, server_port))

# Send data to the server
message = 'Hello server'
ssl_sock.send(message.encode())

# Receive and print response from the server
response = ssl_sock.recv(1024).decode()
print('Server response:', response)

# Close the SSL/TLS socket
ssl_sock.close()
