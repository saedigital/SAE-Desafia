
function Start() {
    this.url = `http://localhost:9098`;
    this.init();
}

Start.prototype.init = function() {
    this.getEvents();

    const args = {
        allowNegative: false,
        negativeSignAfter: false,
        prefix: '',
        suffix: '',
        fixed: true,
        fractionDigits: 2,
        decimalSeparator: ',',
        thousandsSeparator: '.',
        cursor: 'move'
      };

      SimpleMaskMoney.setMask('#ticket_value', args);
};

Start.prototype.getEvents = function() {
    const endpoint =this.url + `/events/`;
    let modelTable = this.getItemTable('model-list-events');
    document.getElementById('list-events').innerHTML = '';

    fetch(endpoint).then(response => { 
        return response.json();
    }).then(result => {
        let html = '';
        let tmpList = '';
        for(var key in result.data) {
            tmpList = modelTable;
            tmpList = tmpList.replace('[id]', result.data[key].id);
            tmpList = tmpList.replace('[id]', result.data[key].id);
            tmpList = tmpList.replace('[id]', result.data[key].id);
            tmpList = tmpList.replace('[title]', result.data[key].title);
            tmpList = tmpList.replace('[value]', result.data[key].ticket_value);
            tmpList = tmpList.replace('[total]', result.data[key].total);
            tmpList = tmpList.replace('[tickets_limit]', result.data[key].tickets_limit);
            tmpList = tmpList.replace('[tickets_sold]', result.data[key].tickets_sold);
            html += tmpList;
        }

        document.getElementById('list-events').innerHTML = html;
    });
};

Start.prototype.getItemTable = function(id) {
    let modelList = document.getElementById(id).innerHTML;
    modelList = modelList.replace('<tbody>', '');
    modelList = modelList.replace('</tbody>', '');

    return modelList;
};

Start.prototype.closeForm = function() {
    document.getElementById('form-event-box').style.display="none";
    document.getElementById('box-table-events').style.display="block";
}

Start.prototype.addEvent = function() {

    document.getElementById('id').value = '';
    document.getElementById('title').value = '';
    document.getElementById('description').value = '';
    document.getElementById('ticket_value').value = '';
    document.getElementById('tickets_limit').value = '';
    
    document.getElementById('box-table-events').style.display="none";
    document.getElementById('form-event-box').style.display="block";

    return false;
};

Start.prototype.editEvent = function(id) {
    const endpoint =this.url + `/events/details/` + id;

    fetch(endpoint).then(response => { 
        return response.json();
    }).then(result => {
        document.getElementById('box-table-events').style.display="none";
        document.getElementById('form-event-box').style.display="block";

        document.getElementById('id').value = result.data.id;
        document.getElementById('title').value = result.data.title;
        document.getElementById('description').value = result.data.description;
        document.getElementById('ticket_value').value = result.data.ticket_value;
        document.getElementById('tickets_limit').value = result.data.tickets_limit;
    });
};

Start.prototype.saveEvent = function() {

    let id = document.getElementById('id').value;
    if (id != '') {
        this.updateEvent();
    } else {
        this.newEvent();
    }
};

Start.prototype.newEvent = function() {
    const endpoint =this.url + `/events/add/`;
    let pars = {
        title:document.getElementById('title').value,
        description:document.getElementById('description').value,
        ticket_value:document.getElementById('ticket_value').value,
        tickets_limit:document.getElementById('tickets_limit').value
    };
    fetch(endpoint, {
        method: 'POST',
        headers: {'Content-Type':'application/json'}, 
        body: JSON.stringify(pars)
    }).then(response => { 
        return response.json();
    }).then(result => {

        document.getElementById('form-event-box').style.display="none";
        document.getElementById('box-table-events').style.display="block";

        this.getEvents();
    });
}

Start.prototype.updateEvent = function() {
    const endpoint =this.url + `/events/update/`;
    let pars = {
        id: document.getElementById('id').value,
        title:document.getElementById('title').value,
        description:document.getElementById('description').value,
        ticket_value:document.getElementById('ticket_value').value,
        tickets_limit:document.getElementById('tickets_limit').value
    };
    fetch(endpoint, {
        method: 'POST',
        headers: {'Content-Type':'application/json'}, 
        body: JSON.stringify(pars)
    }).then(response => { 
        return response.json();
    }).then(result => {

        document.getElementById('form-event-box').style.display="none";
        document.getElementById('box-table-events').style.display="block";

        this.getEvents();
    });
}

Start.prototype.booking = function(id) {
    const endpoint = this.url + `/tickets/event/` + id;
    let modelTable = this.getItemTable('model-list-book');
    document.getElementById('list-book').innerHTML = '';

    fetch(endpoint, {
        method: 'GET',
        headers: {'Content-Type':'application/json'}, 
    }).then(response => { 
        return response.json();
    }).then(result => {
        document.getElementById('box-table-events').style.display="none";
        document.getElementById('box-reserve').style.display="block";

        document.getElementById('title-event').innerHTML = result.data.event.title;
        document.getElementById('event-book').value = result.data.event.id;
        
        let html = '';
        let tmpList = '';
        let numberBook = result.data.event.tickets_limit;
        
        var itensBook = new Array();
        result.data.tickets_data.forEach(element => {
            itensBook.push(parseInt(element.reserve_number));
        });

        let index = 0;
        for(var i = 0; i < numberBook; ++i) {
            index = (i + 1);
            tmpList = modelTable;
            tmpList = tmpList.replace('[number]', index);
            tmpList = tmpList.replace('[number]', index);
            
            if (itensBook.indexOf(index) != -1) {
                tmpList = tmpList.replace('[block-book]', ' checked ');
            } else {
                
                tmpList = tmpList.replace('[block-book]', '');
            }
            html += tmpList;
        }

        document.getElementById('list-book').innerHTML = html;

    });
};

Start.prototype.saveBook = function() {
    const endpoint = this.url + `/tickets/booking`;
    
    let listBooks = document.getElementById('list-book');
    let books = listBooks.getElementsByTagName("input");
    let selectedItems = new Array();                                                                 
    
    for (var i = 0; i < books.length; i++) {                                                          
        if (books[i].checked) {                                                                       
            selectedItems.push( parseInt(books[i].value) );                                                      
        }                                                                                                     
    } 
    
    let pars = {
        event_id : document.getElementById('event-book').value,
        books : selectedItems.join(',')
    }
    
    fetch(endpoint, {
        method: 'POST',
        headers: {'Content-Type':'application/json'}, 
        body: JSON.stringify(pars)
    }).then(response => { 
        return response.json();
    }).then(result => {
        document.getElementById('box-reserve').style.display="none";
        document.getElementById('box-table-events').style.display="block";

        this.getEvents();
    });
};

Start.prototype.closeBook = function() {
    document.getElementById('box-reserve').style.display="none";
    document.getElementById('box-table-events').style.display="block";
    
};

Start.prototype.deleteEvent = function(id) {
    const endpoint = this.url + `/events/delete`;
    
    fetch(endpoint, {
        method: 'POST',
        headers: {'Content-Type':'application/json'}, 
        body: JSON.stringify({id:id})
    }).then(response => { 
        return response.json();
    }).then(result => {
        this.getEvents();
    });
};

Start.prototype.navApp = function(href) {

    href  = href.replace(document.URL, '');
    let parts = href.split('/');
    let lastItem = 0;
    if (!isNaN(parts[parts.length - 1])) {
        lastItem = parts[parts.length - 1];
    }

    if (href.indexOf('events/edit/') >= 0 ) {
        this.editEvent(lastItem);
    } else if (href.indexOf('events/delete/') >= 0  ) {
        console.log('delete evento');
        this.deleteEvent(lastItem);
    } else if (href.indexOf('events/add') >= 0  ) {
        this.addEvent(lastItem);
    } else if (href.indexOf('booking') >= 0  ) {
        this.booking(lastItem);
    } 

    //history.pushState({}, 'Page', href);
    return false;
};

window.onload = function() {
    window.start = new Start();  
};