<?php
    // menu.php é incluído em todas as páginas com: include_once "menu.php"
    // Ele exibe a barra de navegação no topo do sistema
?>

<!-- Navbar do Materialize — fixed-top faz ela ficar fixa no topo da página -->
<nav class="nav-extended" id="menu-principal">
    <div class="nav-wrapper">

        <!-- Logo/nome do sistema — ao clicar vai para o dashboard -->
        <a href="/equipe-moveis/VIEW/dashboard.php" class="brand-logo left">
            <img src="/equipe-moveis/images/Whats_logo.jpeg" alt="Logo" style="margin: 15px 0 0 15px; max-width: 120px;">
        </a>

        <!-- Ícone do menu hamburguer — aparece só no celular -->
        <a href="#" data-target="menu-mobile" class="sidenav-trigger right">
            <i class="material-icons">menu</i>
        </a>

        <!-- Links do menu — ficam visíveis no desktop (hide-on-med-and-down oculta no celular) -->
        <ul class="right hide-on-med-and-down">

            <!-- Cada <li> é um item do menu -->
            <li><a href="/equipe-moveis/VIEW/PRODUTO/lstProduto.php">
                <i class="material-icons left">inventory_2</i>Produtos
            </a></li>

            <li><a href="/equipe-moveis/VIEW/FORNECEDOR/lstFornecedor.php">
                <i class="material-icons left">local_shipping</i>Fornecedores
            </a></li>

            <li><a href="/equipe-moveis/VIEW/MOVEL/lstMovel.php">
                <i class="material-icons left">chair</i>Móveis
            </a></li>

            <li><a href="/equipe-moveis/VIEW/NOTA_FISCAL/lstNotaFiscal.php">
                <i class="material-icons left">receipt_long</i>Notas Fiscais
            </a></li>

            <li><a href="/equipe-moveis/VIEW/USUARIO/lstUsuario.php">
                <i class="material-icons left">people</i>Usuários
            </a></li>

            <!-- Separador visual + botão de logout -->
            <li><a href="/equipe-moveis/VIEW/logout.php">
                <i class="material-icons left">logout</i>Sair
            </a></li>

        </ul>
    </div>
</nav>

<!-- Menu lateral para celular (sidenav) -->
<!-- O id "menu-mobile" é referenciado no data-target do botão hamburguer acima -->
<ul class="sidenav" id="menu-mobile">
    <li><a href="/equipe-moveis/VIEW/dashboard.php">Dashboard</a></li>
    <li><a href="/equipe-moveis/VIEW/PRODUTO/lstProduto.php">Produtos</a></li>
    <li><a href="/equipe-moveis/VIEW/FORNECEDOR/lstFornecedor.php">Fornecedores</a></li>
    <li><a href="/equipe-moveis/VIEW/MOVEL/IstMovel.php">Móveis</a></li>
    <li><a href="/equipe-moveis/VIEW/NOTA_FISCAL/lstNotaFiscal.php">Notas Fiscais</a></li>
    <li><a href="/equipe-moveis/VIEW/USUARIO/lstUsuario.php">Usuários</a></li>
    <li class="divider"></li>
    <li><a href="/equipe-moveis/VIEW/logout.php">Sair</a></li>
</ul>