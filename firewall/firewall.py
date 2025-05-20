#WIP

import re
import json
from http.server import BaseHTTPRequestHandler, HTTPServer

# Define a simple SQL injection pattern
SQL_INJECTION_PATTERN = re.compile(r"(union.*select.*\w+.*from.*\w+|select.*from.*information_schema.tables|select.*from.*mysql.*user|select.*from.*pg_catalog.pg_user)", re.IGNORECASE)

class SimpleWAF(BaseHTTPRequestHandler):
    def do_GET(self):
        self._check_sql_injection(self.path)
        self.send_response(200)
        self.send_header('Content-type', 'application/json')
        self.end_headers()
        self.wfile.write(json.dumps({"message": "Request is safe"}).encode())

    def do_POST(self):
        content_length = int(self.headers['Content-Length'])
        post_data = self.rfile.read(content_length).decode()
        self._check_sql_injection(post_data)
        self.send_response(200)
        self.send_header('Content-type', 'application/json')
        self.end_headers()
        self.wfile.write(json.dumps({"message": "Request is safe"}).encode())

    def _check_sql_injection(self, data):
        if SQL_INJECTION_PATTERN.search(data):
            self.send_response(403)
            self.end_headers()
            self.wfile.write(json.dumps({"error": "SQL Injection detected"}).encode())
            self.wfile.flush()
            raise Exception("SQL Injection detected")

def run(server_class=HTTPServer, handler_class=SimpleWAF, port=8080):
    server_address = ('', port)
    httpd = server_class(server_address, handler_class)
    print(f'Starting WAF server on port {port}...')
    httpd.serve_forever()

if __name__ == '__main__':
    run()

