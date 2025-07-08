<h1>
    <?php echo $usuario['nome'] ?? ''?>
    <a id="btn_logout" href="/logout">Sair</a>
</h1>
<table>
    <thead>
        <tr>
            <td>id</td> <td>titulo</td> <td>descricao</td>
        </tr>
    </thead>
<tbody>
    <?php
foreach($tarefas as $tarefa){
    echo "<tr> <td>{$tarefa['id']}</td> <td>{$tarefa['titulo']}</td>
    <td>{$tarefa['descricao']}</td> </tr>";
}




?>
</tbody>

</table>