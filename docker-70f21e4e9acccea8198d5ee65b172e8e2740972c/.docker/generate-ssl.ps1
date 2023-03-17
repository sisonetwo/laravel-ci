$Env:SITE_NAME="docker_pemula_sampai_mahir";
$Env:CERT_FOLDER=".docker\ssl\certs";
$Env:CERT_KEY_FOLDER=".docker\ssl\key";

echo "remove existing certs in [$Env:CERT_FOLDER, $Env:CERT_KEY_FOLDER]"
rm -Force -Recurse $Env:CERT_FOLDER;
rm -Force -Recurse $Env:CERT_KEY_FOLDER;

echo "create directory [$Env:CERT_FOLDER, $Env:CERT_KEY_FOLDER]"

mkdir $Env:CERT_FOLDER;
mkdir $Env:CERT_KEY_FOLDER;

openssl dhparam -out $Env:CERT_FOLDER\$Env:SITE_NAME.pem 2048;

openssl req -new `
-x509 `
-newkey rsa:2048 `
-nodes `
-days 365 `
-keyout $Env:CERT_KEY_FOLDER\$Env:SITE_NAME.key `
-out $Env:CERT_FOLDER\$Env:SITE_NAME.crt;

echo "certs file: $Env:CERT_FOLDER\$Env:SITE_NAME.crt";
echo "secretkey file: $Env:CERT_KEY_FOLDER\$Env:SITE_NAME.key";
echo "dhparam file: $Env:CERT_FOLDER\$Env:SITE_NAME.pem";
