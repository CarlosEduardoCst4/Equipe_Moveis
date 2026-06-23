<?php
    session_start();
    if (!isset($_SESSION['login']))
        header("location: /equipe-moveis/VIEW/index.php");

    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/equipe-moveis/DAL/dashboard.php";

    $dash = new \DAL\Dashboard();

    $totalProdutos     = $dash->TotalProdutos();
    $estoqueBaixo      = $dash->ProdutosEstoqueBaixo();
    $produtosZerados   = $dash->ProdutosZerados();
    $totalMoveis       = $dash->TotalMoveis();
    $totalFornecedores = $dash->TotalFornecedores();
    $produtosCriticos  = $dash->ProdutosCriticos();
    $ultimosMoveis     = $dash->UltimosMoveis();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard — Equipe Móveis</title>
    <link rel="icon" href="/equipe-moveis/images/logo.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Todo o CSS agora vem do arquivo externo -->
    <link rel="stylesheet" href="/equipe-moveis/VIEW/css/style.css">
</head>
<body>
    <?php include_once "menu.php"; ?>

    <div class="container" style="margin-top: 24px;">

        <!-- Título -->
        <div style="margin-bottom: 16px;">
            <div style="font-size: 18px; font-weight: 500; color: #E6F1FB;">Dashboard</div>
            <div style="font-size: 11px; color: #378ADD; margin-top: 2px;">
                Visão geral do estoque · Bem-vindo, <strong><?php echo $_SESSION['login']; ?></strong>
            </div>
        </div>

        <!-- Cards do topo -->
        <div class="dash-top">
            <div class="dash-top-card">
                <div class="dtc-label">Total de produtos</div>
                <div class="dtc-value"><?php echo $totalProdutos; ?></div>
                <div class="dtc-meta">cadastrados no sistema</div>
            </div>
            <div class="dash-top-card">
                <div class="dtc-label">Móveis cadastrados</div>
                <div class="dtc-value"><?php echo $totalMoveis; ?></div>
                <div class="dtc-meta">registros ativos</div>
            </div>
            <div class="dash-top-card">
                <div class="dtc-label">Alertas críticos</div>
                <div class="dtc-value" style="color: #F09595;"><?php echo $estoqueBaixo; ?></div>
                <div class="dtc-meta">
                    <span class="badge-s danger">● Estoque mínimo</span>
                </div>
            </div>
            <div class="dash-top-card">
                <div class="dtc-label">Fornecedores</div>
                <div class="dtc-value"><?php echo $totalFornecedores; ?></div>
                <div class="dtc-meta">parceiros ativos</div>
            </div>
        </div>

        <!-- Grid meio: alertas + categorias -->
        <div class="dash-mid">

            <!-- Alertas de estoque -->
            <div class="dash-panel">
                <div class="dash-panel-header">
                    <span class="dash-panel-title">Alertas de estoque</span>
                    <a href="/equipe-moveis/VIEW/PRODUTO/lstProduto.php" class="dash-panel-link">
                        Ver todos →
                    </a>
                </div>

                <?php if (count($produtosCriticos) == 0): ?>
                    <p style="color:#97C459; font-size:12px;">
                        <i class="material-icons tiny">check_circle</i>
                        Todos os produtos estão OK!
                    </p>
                <?php else: ?>
                    <?php foreach ($produtosCriticos as $p):
                        if ($p->estoque_atual <= 0) {
                            $dotClass  = 'red';
                            $badgeClass = 'danger';
                            $badgeText  = 'Zerado';
                        } else {
                            $dotClass  = 'yellow';
                            $badgeClass = 'warn';
                            $badgeText  = 'Atenção';
                        }
                    ?>
                    <div class="alerta-item">
                        <div class="alerta-dot <?php echo $dotClass; ?>"></div>
                        <div class="alerta-info">
                            <div class="alerta-nome"><?php echo $p->descricao; ?></div>
                            <div class="alerta-sub">
                                <?php echo $p->estoque_atual; ?> unid. restantes · mín. <?php echo $p->estoque_minimo; ?>
                            </div>
                        </div>
                        <span class="badge-s <?php echo $badgeClass; ?>"><?php echo $badgeText; ?></span>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Últimos móveis com barras -->
            <div class="dash-panel">
                <div class="dash-panel-header">
                    <span class="dash-panel-title">Últimos móveis cadastrados</span>
                    <a href="/equipe-moveis/VIEW/movel/lstMovel.php" class="dash-panel-link">
                        Ver todos →
                    </a>
                </div>

                <?php if (count($ultimosMoveis) == 0): ?>
                    <p style="color:#85B7EB; font-size:12px;">Nenhum móvel cadastrado ainda.</p>
                <?php else: ?>
                    <?php
                        // Pega o maior preço para calcular a barra proporcional
                        $maxPreco = max(array_column((array)$ultimosMoveis, 'preco_venda'));
                    ?>
                    <?php foreach ($ultimosMoveis as $m):
                        $pct = $maxPreco > 0 ? round(($m->preco_venda / $maxPreco) * 100) : 0;
                    ?>
                    <div class="bar-row">
                        <div class="bar-label"><?php echo mb_strimwidth($m->descricao, 0, 14, '..'); ?></div>
                        <div class="bar-track">
                            <div class="bar-fill" style="width:<?php echo $pct; ?>%;background:#185FA5;"></div>
                        </div>
                        <div class="bar-val" style="color:#97C459;">
                            R$<?php echo number_format($m->preco_venda, 0, ',', '.'); ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="/equipe-moveis/VIEW/js/init.js"></script>
</body>
</html>