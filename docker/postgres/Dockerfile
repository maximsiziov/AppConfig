FROM postgres:latest
RUN buildDependencies="ca-certificates \
libsybdb5 \
freetds-dev \
freetds-common \
freetds-bin \
wget \
gcc \
make \
git \
postgresql-server-dev-$PG_MAJOR" \
&& apt-get update \
&& apt-get install -y ${buildDependencies} \
&& git clone https://github.com/tds-fdw/tds_fdw.git \
&& cd tds_fdw \
&& make USE_PGXS=1 install \
&& sed -i '/# TDS protocol version/a \\ttds version=7.1' /etc/freetds/freetds.conf
ENV POSTGRES_DB mcdreports_accounts
#ADD initial/tvdata_app_schema.sql /docker-entrypoint-initdb.d/tvdata_app_schema.sql
#ADD ./initial/tvdata_table_migration.sql /docker-entrypoint-initdb.d/tvdata_table_migration.sql
#ADD ./initial/tvdata_bigtv_rus_schema.sql /docker-entrypoint-initdb.d/tvdata_bigtv_rus_schema.sql
#ADD ./initial/tvdata_cities_raw_schema.sql /docker-entrypoint-initdb.d/tvdata_cities_raw_schema.sql
#ADD ./initial/tvdata_cities19_1_schema.sql /docker-entrypoint-initdb.d/tvdata_cities19_1_schema.sql
#ADD ./initial/x_manual_additional.sql /docker-entrypoint-initdb.d/x_manual_additional.sql
#ADD ./initial/z_dem20180202.sql /docker-entrypoint-initdb.d/z_dem20180202.sql
#ADD ./initial/z_swd20180202.sql /docker-entrypoint-initdb.d/z_swd20180202.sql
#ADD ./initial/z_rgn_tv_raw.sql /docker-entrypoint-initdb.d/z_rgn_tv_raw.sql