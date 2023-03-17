export SITE_NAME=docker_pemula_sampai_mahir;
export CERT_FOLDER=.docker/ssl/certs;
export CERT_KEY_FOLDER=.docker/ssl/key;

echo "remove existing ssl certs in [${CERT_FOLDER}, ${CERT_KEY_FOLDER}]";
# initial folder
rm -rf ${CERT_FOLDER}
rm -rf ${CERT_KEY_FOLDER}

echo "re-create directory [${CERT_FOLDER}, ${CERT_KEY_FOLDER}]"
mkdir -p ${CERT_FOLDER}
mkdir -p ${CERT_KEY_FOLDER}

openssl dhparam -out ${CERT_FOLDER}/$SITE_NAME.pem 2048;
openssl req -new \
-x509 \
-newkey rsa:2048 \
-nodes \
-days 365 \
-keyout $CERT_KEY_FOLDER/$SITE_NAME.key \
-out $CERT_FOLDER/$SITE_NAME.crt;

echo "certs file: $CERT_FOLDER/$SITE_NAME.crt" && \
echo "secretkey file: $CERT_KEY_FOLDER/$SITE_NAME.key" && \
echo "dhparam file: ${CERT_FOLDER}/$SITE_NAME.pem"
