var jsstoreCon = new JsStore.Connection();

window.onload = function () {
    //refreshTableData();
    //registerEvents();
    initDb();
};

async function initDb() {
    var isDbCreated = await jsstoreCon.initDb(getDbSchema());
    if (isDbCreated) {
        console.log('db created');
    }
    else {
        console.log('db opened');
    }
}

function getDbSchema() {
    var table = {
        name: 'user',
        columns: {
            id: {
                primaryKey: true,
                autoIncrement: true
            },
            name: {
                notNull: true,
                dataType: 'string'
            },
            pwd: {
                dataType: 'string',
                default: ''
            }        
        }
    }

    var db = {
        name: 'My-Db',
        tables: [table]
    }
    return db;
}