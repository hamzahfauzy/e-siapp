let selected_tahun = document.querySelector("[name='capaian[tahun]']")

let prioritas = document.querySelector("[name='capaian[prioritas]']")
if(prioritas)
{
    prioritas.addEventListener('change', async function(e){
        let val = this.value

        try {
            // fetch to get kegiatan
            var request = await fetch('index.php?r=api/get-kegiatan&kd_prioritas='+val)
            var response = await request.json()
            appendToSelect(
                document.querySelector("[name='capaian[program_prioritas]']"),
                response.data,
                'program_prioritas',
                'program_prioritas'
            )
        } catch (error) {
            
        }
    })
}

let program_prioritas = document.querySelector("[name='capaian[program_prioritas]']")
if(program_prioritas)
{
    program_prioritas.addEventListener('change', async function(e){
        let val = this.value

        try {
            // fetch to get kegiatan
            var request = await fetch('index.php?r=api/get-kegiatan&kd_prioritas='+prioritas.value+'&program_prioritas='+val)
            var response = await request.json()
            appendToSelect(
                document.querySelector("[name='capaian[kegiatan]']"),
                response.data,
                'kegiatan_'+selected_tahun.value,
                'kegiatan_'+selected_tahun.value
            )
        } catch (error) {
            
        }
    })
}

let kegiatan = document.querySelector("[name='capaian[kegiatan]']")
if(kegiatan)
{
    kegiatan.addEventListener('change', async function(e){
        let val = this.value

        try {
            // fetch to get kegiatan
            var request = await fetch('index.php?r=api/get-kegiatan&kd_prioritas='+prioritas.value+'&program_prioritas='+program_prioritas.value+'&kegiatan_'+selected_tahun.value+'='+val)
            var response = await request.json()
            document.querySelector("[name='capaian[target]']").value = response.data[0]['target_'+selected_tahun.value]
        } catch (error) {
            
        }
    })
}