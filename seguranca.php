<?php
function protectPage() {
	global $_SG;
	
	if (! isset ( $_SESSION ['usuarioID'] ) or ! isset ( $_SESSION ['usuarioNome'] )) {
		// N�o h� usu�rio logado, manda pra p�gina de login
		kick_out ();
	} else if (! isset ( $_SESSION ['usuarioID'] ) or ! isset ( $_SESSION ['usuarioNome'] )) {
		// H� usu�rio logado, verifica se precisa validar o login novamente
		if ($_SG ['validaSempre'] == true) {
			// Verifica se os dados salvos na sess�o batem com os dados do banco de dados
			if (! validaUsuario ( $_SESSION ['usuarioLogin'], $_SESSION ['usuarioSenha'] )) {
				// Os dados n�o batem, manda pra tela de login
				kick_out ();
			}
		}
	}
}

/**
 * Fun��o para expulsar um visitante
 */
function kick_out() {
	global $_SG;
	
	// Remove as vari�veis da sess�o (caso elas existam)
	unset ( $_SESSION ['usuarioID'], $_SESSION ['usuarioNome'], $_SESSION ['usuarioLogin'], $_SESSION ['usuarioSenha'] );
	
	// Manda pra tela de login
	header ( "Location:../../index.php?page=login&tentativa=tentei" );
}
?>