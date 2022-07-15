function appendToSelect(el, data, id, val, selected = false)
{
    // reset the select
    el.innerHTML = '<option>- Pilih -</option>'
    data.forEach(d => {
        el.innerHTML += '<option value="'+d[id]+'" '+(selected && selected == d[id] ? 'selected=""' : '')+'>'+d[val]+'</option>'
    })
}