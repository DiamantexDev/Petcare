#!/bin/sh
set -e

# O Render grava os Secret Files em /etc/secrets com acesso restrito.
# Este script roda como root antes do Apache: copia o certificado para um
# local que o usuário do Apache (www-data) consegue ler.
SOURCE="${DB_SSL_CA:-}"
TARGET=/var/www/ca.pem

if [ -n "$SOURCE" ] && [ -f "$SOURCE" ] && [ "$SOURCE" != "$TARGET" ]; then
    cp "$SOURCE" "$TARGET"
    chown www-data:www-data "$TARGET"
    chmod 0444 "$TARGET"
    export DB_SSL_CA="$TARGET"
    echo "[PetCare] Certificado CA copiado de $SOURCE para $TARGET"
elif [ -n "$SOURCE" ] && [ ! -f "$SOURCE" ]; then
    echo "[PetCare] AVISO: DB_SSL_CA aponta para $SOURCE, mas o arquivo não existe (Secret File ca.pem foi criado?)"
fi

# Diagnóstico no log do Render: o certificado é válido?
if [ -n "${DB_SSL_CA:-}" ] && [ -f "$DB_SSL_CA" ]; then
    php -r '$c = @openssl_x509_parse(file_get_contents(getenv("DB_SSL_CA"))); echo $c ? "[PetCare] Certificado CA válido: " . ($c["subject"]["CN"] ?? "?") . " (expira " . date("Y-m-d", $c["validTo_time_t"]) . ")\n" : "[PetCare] ERRO: o conteúdo do certificado CA é inválido (confira o Secret File ca.pem)\n";'
fi

exec "$@"
