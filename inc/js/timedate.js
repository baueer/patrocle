var div = document.getElementById('timedate');
        
function getUserTimeDate() {
    var date = new Date();
    let h = date.getHours();
    let m = date.getMinutes().toString();
    let d = date.getDate().toString();
    let mo = date.getMonth().toString();
    let y = date.getFullYear().toString();

    var format = 'AM';
    if(h>12) {
        format = 'PM';
        h -= 12;
    }
    h = h.toString();
    if(h.length == 1) {
        h = '0' + h;
    }
    if(m.length == 1) {
        m = '0' + m;
    }
    if(d.length == 1) {
        d = '0' + d;
    }
    if(mo.length == 1) {
        mo = '0' + mo;
    }
            
    var time = h + ':' + m + format + ' - ' + d + '/' + mo + '/' + y;
    div.innerHTML = time;
}
getUserTimeDate();

setInterval(() => {
    getUserTimeDate();
}, 5000);