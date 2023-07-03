package controller;

import model.Produto;
import modelDAO.ProdutoDAO;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;
import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

public class GerenciarProduto extends HttpServlet {

    // <editor-fold defaultstate="collapsed" desc="HttpServlet methods. Click on the + sign on the left to edit the code.">
    /**
     * Handles the HTTP <code>GET</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html");

        PrintWriter out = response.getWriter();
        String acao = request.getParameter("acao");

        String idProduto = request.getParameter("idProduto");
        String mensagem = "";

        try {
            Produto pr = new Produto();
            ProdutoDAO prDAO = new ProdutoDAO();

            if (acao.equals("listar")) {
                ArrayList<Produto> produtos = new ArrayList<>();
                produtos = prDAO.getLista();
                RequestDispatcher dispatcher = getServletContext().getRequestDispatcher("/listar_produto.jsp");
                request.setAttribute("produtos", produtos);
                dispatcher.forward(request, response);

            } else if (acao.equals("alterar")) {
                pr = prDAO.getCarregaPorID(Integer.parseInt(idProduto));
                if (pr.getIdProduto() > 0) {
                    RequestDispatcher disp = getServletContext().getRequestDispatcher("/form_produto.jsp");
                    request.setAttribute("produto", pr);
                    disp.forward(request, response);
                } else {
                    mensagem = "Produto não encontrado na base de dados!";
                }

            } else if (acao.equals("ativar")) {
                pr = prDAO.getCarregaPorID(Integer.parseInt(idProduto));
                if (prDAO.ativar(pr)) {
                    mensagem = "Produto ativado com sucesso!";
                } else {
                    mensagem = "Falha ao ativar o produto!";
                }
            } else if (acao.equals("desativar")) {
                pr = prDAO.getCarregaPorID(Integer.parseInt(idProduto));
                if (prDAO.desativar(pr)) {
                    mensagem = "Produto desativado com sucesso!";
                } else {
                    mensagem = "Falha ao desativar o produto!";
                }

            }

        } catch (Exception e) {
            mensagem = "Erro: " + e;
        }
        out.println("<script type='text/javascript'>");
        out.println("alert('" + mensagem + "');");
        out.println("location.href='listar_produto.jsp';");
        out.println("</script>");

    }

    /**
     * Handles the HTTP <code>POST</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html");
        response.setCharacterEncoding("UTF-8");

        PrintWriter out = response.getWriter();
        String idProduto = request.getParameter("idProduto");
        String nome = request.getParameter("nome");
        String qtd = request.getParameter("qtd");
        String valor = request.getParameter("valor");
        String status = request.getParameter("status");

        String mensagem = "";

        

        try {
            Produto pr = new Produto();
            if (!idProduto.isEmpty()) {
                pr.setIdProduto(Integer.parseInt(idProduto));
            }

            if (nome.equals("") || qtd.equals("") || valor.equals("") || status.equals("")) {
                mensagem = "Campos Obrigatorios deverão ser preenchidos!";
            } else {
                pr.setNome(nome);
                pr.setQtd(Integer.parseInt(qtd));
                double novovalor = 0;
                if (!valor.isEmpty()) {
                    novovalor = Double.parseDouble(valor.replace(".", "").replace(",", "."));

                }
                pr.setValor(novovalor);

                ProdutoDAO prDAO = new ProdutoDAO();
                if (prDAO.gravar(pr)) {
                    mensagem = "Gravado com sucesso!";
                } else {
                    mensagem = "Erro ao gravar no banco de dados";
                }
            }
        } catch (Exception e) {
            out.print(e);
            mensagem = "Erro ao Executar";
        }
        out.println("<script type='text/javascript'>");
        out.println("alert('" + mensagem + "');");
        out.println("location.href='listar_produto.jsp';");
        out.println("</script>");
    }

    @Override
    public String getServletInfo() {
        return "Short description";
    }// </editor-fold>

}
