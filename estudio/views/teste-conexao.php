<section class="container">
	<strong>Bico: <span id="bico"></span></strong>
	<strong>Mesa: <span id="mesa"></span></strong>
</section><!--container-->

<script type="text/javascript">
	function atualizarDadosImpressora() {
        fetch('<?php echo PATH?>app/Controllers/impressora.php', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data) {
            	console.log(data);
                document.getElementById('bico').innerText = data.nozzleTemp + ' °C';
                document.getElementById('mesa').innerText = data.bedTemp0 + ' °C';
            } 
        })
        .catch(error => {
            console.error('Erro na requisição:', error);
            // Opcional: Mostrar erro na tela se a conexão cair
        });
    }

    function enviarDadosImpressora(dados){
    	
    }

    atualizarDadosImpressora();

    setInterval(atualizarDadosImpressora, 1000);
</script>