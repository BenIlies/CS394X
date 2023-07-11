module vault;

export {
    # Define a new log ID called "LOG"
    redef enum Log::ID += { LOG };
    
    # Define a record type called "Info" to store packet information
    type Info: record {
        orig_h: addr &log;       # Original host IP address
        orig_p: port &log;       # Original host port
        resp_h: addr &log;       # Response host IP address
        resp_p: port &log;       # Response host port
        flags: string &log;      # TCP flags
        seq: count &log;         # TCP sequence number
        ack: count &log;         # TCP acknowledgment number
        len: count &log;         # TCP payload length
        payload: string &log;    # TCP payload data
    };
}

event zeek_init()
{
    # Create a new log stream called "vault.log" with columns matching the "Info" record
    Log::create_stream(vault::LOG, [$columns=Info, $path="vault.log"]);
}

event tcp_packet(c: connection, is_orig: bool, flags: string, seq: count, ack: count, len: count, payload: string)
{
    # Check if the packet is originating from the specified IP address and port
    if (is_orig && c$id$resp_h == to_addr("10.10.1.231") && c$id$resp_p == to_port("9999/tcp"))
    {
        # Create a new instance of the "Info" record and populate it with packet information
        local rec: vault::Info = [$orig_h = c$id$orig_h, $orig_p = c$id$orig_p, $resp_h = c$id$resp_h, $resp_p = c$id$resp_p,
                                  $flags = flags, $seq = seq, $ack = ack, $len = len, $payload = payload];
        
        # Write the record to the "vault.log" log stream
        Log::write(vault::LOG, rec);
    }
}
