
# Get famous api 

This project is build on Laravel 10 with Postgres DB. The application can be run using following docker compose command 

`docker compose up --build`.

While starting the project with docker, migration files are run to setup the User table and other default tables. User table is filled with the data given on data.json using laravel seeding feature. 

The api documentation can be viewed at: 

`http://localhost:8000/api/documentation#/default`


#### Use case 1 and 2 can be explored with the end points provided in the documentation.

### Use case 3 
In order to view different KPIs of the residents and also to reduce the data access delays, following strategies can be considered:

- Aggregating Queries: We can optimize our queries by querying just the aggregation and table first by 
- Indexing: Indexing only the columns which are relevant for KPI views e.g ages, gender etc.
- KPIs can be aggregated and stored in cache i.e Redis in order to have quicker access. Cache can be updated after some delays .e.g after 30mins
-  Data partitioning and sharding should also be considered in order to improve query response time. 

### Use case 4

The api to view the quote from the api can be view from the end point mentioned in the document 
