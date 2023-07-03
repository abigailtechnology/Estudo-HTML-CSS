<%@page import= "model.Menu" import= "model.MenuDAO"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c" %>
<%@taglib uri="http://java.sun.com/jsp/jstl/fmt" prefix="fmt" %>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="bootstrap/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="webfonts/css/all.css" type="text/css">
        <title>Produtos</title>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Produto</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="index.jsp">Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="form_produto.jsp" class="btn btn-primary btn-md" role="button">Cadastrar Produto</a>
                            </li>
                        </ul>   
                    </div>
                </div>
            </nav>
        </header>
        <div class="container">
            <table border="1" width="500">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Link</th>
                        <th>Exibir</th>
                        <th align="center"> Ações</th>
                    </tr>
                </thead>
                <tfoot>

                </tfoot>
                <jsp:useBean class="model.MenuDAO" id="mDAO"/>
                <tbody>
                    <c:forEach items="${menus}" var="m">
                        <tr>
                            <td>${m.idMenu}</td>
                            <td>${m.nome}</td>
                            <td>${m.link}</td>
                            <td>
                                <c:choose>
                                    <c:when test="${m.exibir == 1}">
                                        Sim
                                    </c:when>
                                    <c:otherwise>
                                        Não
                                    </c:otherwise>
                                </c:choose>
                            </td>
                            <td align="center" >
                                <a href="gerenciar_menu.do?acao=alterar&idMenu=${m.idMenu}"class="btn btn-infoo btn-sm" role="button">Alterar&nbsp;
                                    <i class="fa-solid fa-pen-to-square"></i></a>
                                <script type="text/javascript">

                                    function deletar(idMenu, nome) {
                                        if (confirm("Realmente deseja desativar o menu " + nome + "?")) {
                                            window.open("gerenciar_menu.do?acao=desativar&idMenu=" + idMenu, "_self");
                                        }
                                    }
                                </script>
                            </td>
                        </tr>
                    </c:forEach>
                    </tbody>
            </table>
            <script type="text/javascript" src="datatables/jQuery/jquery-1.12.4.js"></script>
            <script type="text/javascript" src="datatables/DataTables/css/jquery.dataTables.min.css"></script>           
        </div>
    </body>
</html>
