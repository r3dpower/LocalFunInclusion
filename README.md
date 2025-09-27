# LocalFunInclusion
A vulnerable server for learning local file inclusion exploitation

⚠️ Warning: This repository intentionally contains insecure code and is provided only for educational, research, and defensive testing in isolated lab environments. Do not deploy this on production systems or any systems you do not own or have explicit permission to test.

## ⚙️Requirements
Only run this lab in an isolated, controlled environment (VM, container, or isolated network). Do not run on production or public-facing hosts.
- Linux system (Debian/Ubuntu/Kali recommended for examples)
- apache2 web server
- PHP (if the lab uses PHP files)

## 🧩 Learning Objectives

By working on this challenge, you’ll learn to:

Identify LFI vulnerabilities

Exploit log poisoning through LFI

Chain LFI with file uploads to get RCE!

## 🚀 Setup Instructions

1. Clone this repository:

   ```bash
   git clone https://github.com/r3dpower/LocalFunInclusion.git
   cd LocalFunInclusion

2. Copy the lab files into your Apache document root (example for Debian/Ubuntu):
   sudo mkdir -p /var/www/html/shoppix
   sudo cp -r * /var/www/html/shoppix/
   sudo chown -R www-data:www-data /var/www/html/shoppix

3. Enable read permissions on /var/log/apache2/access.log (for log poisoning):
   sudo chown root:www-data /var/log/apache2/access.log
   sudo chmod 0640 /var/log/apache2/access.log


Happy hacking! 🐱‍💻
