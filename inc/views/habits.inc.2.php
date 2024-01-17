<div class="container  scroll-x" id="habits">
    <h5>Ficha de hábitos</h5>

    <form action="?view=habits" method="POST">
        <div class="row">
            <div class="col m6 s12 input-field">
                <input type="text" name="search_habits" required>
                <label>Buscar nome / telefone</label>
            </div>
        </div>

    </form>
    <table class="striped small">
        <thead>
            <tr>

                <!-- <th>ID</th> -->
                <th></th>
                <th>Feito</th>
                <th>Data</th>
                <th>Autor</th>

                <th>Mentor</th>
                <th>Indicado por</th>
                <th>Nome</th>

                <th class="private">Email</th>


                <th>Whatsapp</th>

                <th class="private">Profissão</th> <!-- hide -->
                <th class="private">Área</th><!-- hide -->

                <th class="private">Cidade / estado</th>

                <th>Dificuldades</th>
                <th>Tentativas</th>
                <th>Quantidade de água por dia</th>
                <th>Problemas de saúde</th>
                <th>Sintomas</th>
                <th>Data de nascimento</th>
                <th>Altura</th>
                <th>Peso</th>
                <th>Cintura</th>
                <th>Abdômen</th>
                <th>Quadril</th>
                <th>Porque decidiu mudar</th>
                <th>Porque decidiu se inscrever</th>
                <th>Informações adicionais</th>

                <th class="private">Instagram</th><!-- hide -->


                <th>Que horas acorda</th>
                <th>Qual período do dia a energia é mais baixa</th>
                <th>Que horas almoça</th>
                <th>Que horas janta</th>
                <th>Que horas toma café da manhã</th>
                <th>Lanches entre as refeições</th>
                <th>Que horas vai dormir</th>
                <th>Apoio da familia</th>
                <th>Intestino funciona todo dia</th>
                <th>Tem retenção de líquido</th>
                <th>Faz atividade física</th>
                <th>Faz uso de medicamentos</th>
                <th>Possui alguma intolerância</th>
                <th>Qual período do dia sente mais fome</th>
                <th>Peso desejado</th>


            </tr>
        </thead>
        <tbody id="habitsData">

        </tbody>

    </table>

</div>
<script>
document.querySelectorAll(".private").forEach(elem => {
    elem.parentElement.removeChild(elem)
})
axios.get("/psg-admin/api/habits?all").then(res => {
    res.data.habits.map(row => {
        console.log(row)
        let tr = document.createElement("tr")
        let checked = row.done == "1" ? " checked " : ""

        let deleteTd = document.createElement("td")
        deleteTd.onclick = (e) => {
            if (e.target.localName != "i") return;

            document.getElementById("habitsData").removeChild(e.target.parentElement.parentElement)
        }

        deleteTd.innerHTML = `<i class="material-icons red-text hoverable">delete</i>`

        let doneTd = document.createElement("td")
        doneTd.innerHTML = `
        <p>
        <label>
        <input type="checkbox"${checked} onchange="handleDoneHabits(${row.id})"/>
        <span>Feito</span>
        </label>
        </p>`
        tr.appendChild(deleteTd)
        tr.appendChild(doneTd)

        Object.keys(row).map(key => {
            if ([
                    'done',
                    'id',
                    'done_mentor',
                    'done_author', 'job',
                    'work_area',
                    'instagram',
                    'mail',
                    'city'
                ].includes(key)) return

            let td = document.createElement("td")
            td.innerText = row[key]
            tr.appendChild(td)
        })



        document.getElementById("habitsData").appendChild(tr)
    })
})
</script>