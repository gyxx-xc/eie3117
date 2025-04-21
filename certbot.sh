apt update
apt install python3 python3-venv libaugeas0
python3 -m venv /opt/certbot/
/opt/certbot/bin/pip install --upgrade pip
/opt/certbot/bin/pip install certbot certbot-apache
/usr/bin/certbot  --apache -d gyxxxxxx.store
