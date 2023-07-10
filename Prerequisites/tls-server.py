import socket
import ssl

# Server IP address and port
server_ip = '0.0.0.0'
server_port = 10000

# Paths to server key, certificate, and CA certificate
server_key = 'server.key'
server_cert = 'server.crt'
ca_cert = '394X-CA.crt'

# Create a TCP socket
sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)

# Bind the socket to the server IP and port
sock.bind((server_ip, server_port))

# Listen for incoming connections
sock.listen(1)
print('Server listening on', server_ip, ':', server_port)

# Wrap the socket with SSL/TLS
context = ssl.create_default_context(ssl.Purpose.CLIENT_AUTH)
context.load_cert_chain(certfile=server_cert, keyfile=server_key)
context.load_verify_locations(cafile=ca_cert)
context.verify_mode = ssl.CERT_REQUIRED

while True:
    # Accept incoming connection
    client_sock, client_addr = sock.accept()
    print('Accepted connection from', client_addr)

    # Wrap the client socket with SSL/TLS
    ssl_sock = context.wrap_socket(client_sock, server_side=True)

    # Verify client certificate
    try:
        ssl_sock.do_handshake()
    except ssl.SSLError as e:
        print('Client certificate validation failed:', e)
        ssl_sock.close()
        continue
