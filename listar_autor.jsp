<%-- 
    Document   : listar_autor
    Created on : 10 de jun de 2023, 23:05:53
    Author     : Ana Caroline
--%>
<%@page import= "model.Autor"%>
<%@page import= "model.AutorDAO"%>
<%@page import= "java.util.ArrayList" %>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c" %>
<%@taglib uri="http://java.sun.com/jsp/jstl/fmt" prefix="fmt" %>

<%
    ArrayList<Autor> lista = new ArrayList<>();
    try {
        AutorDAO auDAO = new AutorDAO();
        lista = auDAO.listar();
    } catch (Exception e) {
        out.print("Erro: " + e);
    }
%>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scale=no" name="viewport"/>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="bootstrap/bootstrap-theme.min.css"/>
        <title>Lista de Autor</title>
        <script type="text/javascript">
            function excluirAutor(idAutor, nome) {
                if (confirm("Realmente deseja excluir o autor: " + nome + "?")) {
                    window.open("excluir_autor.do?idAutor=" + idAutor, "_self");
                }
            }
        </script>
    </head>
    <body>
        <h1>Lista de Autor</h1>
        <table border="1" width="500">
            <tr>
                <th>id</th>
                <th>Nome</th>
                <th>Sobrenome</th>
                 <th>Biografia</th>
            </tr>
            
            <tr>
             <%   for (Autor au: lista){%>
             <td><%= au.getIdAutor()%></td>
             <td><%= au.getNome()%></td>
             <td><%= au.getSobrenome()%></td>
             <td><%= au.getBiografia()%></td>
             
             <td align="center" >
                    <a href="form_alterar_autor.jsp?idAutor=<%=au.getIdAutor()%>">Alterar</a>
                    <a href="#" onclick="excluirAutor(<%=au.getIdAutor()%>, '<%=au.getNome() %>')">Excluir</a>
                </td>
            </tr>
            <% } %>
        </table>
        <a href="form_cadastrar_autor.jsp">Cadastrar Novo Autor</a>
        <a href="index.jsp"/> Home </a>
    </body>
</html>
