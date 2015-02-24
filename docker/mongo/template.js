var conn;
try{ conn = new Mongo("localhost:27017");} catch(Error){};
while(conn===undefined) { try{ conn = new Mongo("localhost:27017"); } catch(Error) { sleep(5000)} };
db = conn.getDB("test");
