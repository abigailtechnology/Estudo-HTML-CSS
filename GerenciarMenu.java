package controller;

import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;
import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import model.Menu;
import modelDAO.MenuDAO;

public class GerenciarMenu extends HttpServlet {

    /**
     * Processes requests for both HTTP <code>GET</code> and <code>POST</code>
     * methods.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
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
        response.setCharacterEncoding("UTF-8");
        PrintWriter out = response.getWriter();
        String acao = request.getParameter("acao");
        String idMenu = request.getParameter("idMenu");
        String nome = request.getParameter("nome");
        String link = request.getParameter("link");
        String icone = request.getParameter("icone");
        String exibir = request.getParameter("exibir");

        String mensagem = "";

        try {
            Menu m = new Menu();
            MenuDAO mDAO = new MenuDAO();

            if (acao.equals("listar")) {
                if (GerenciarLogin.verificarPermissao(request, response)) {
                    ArrayList<Menu> menu = new ArrayList<>();
                    menu = mDAO.getLista();
                    RequestDispatcher dispatcher = getServletContext().getRequestDispatcher("/listar_menu.jsp");
                    request.setAttribute("produtos", menu);
                    dispatcher.forward(request, response);

                } else if (acao.equals("alterar")) {
                    m = mDAO.getCarregaPorID(Integer.parseInt(idMenu));
                    if (m.getIdMenu() > 0) {
                        RequestDispatcher disp = getServletContext().getRequestDispatcher("/form_menu.jsp");
                        request.setAttribute("menu", m);
                        disp.forward(request, response);
                    } else {
                        mensagem = "Menu não encontrado na base de dados!";
                    }

                } else if (acao.equals("deletar")) {
                    m = mDAO.getCarregaPorID(Integer.parseInt(idMenu));
                    if (mDAO.deletar(m)) {
                        mensagem = "Menu deletado com sucesso!";
                    } else {
                        mensagem = "Falha ao deletar o menu!";
                    }

                }

            }
        } catch (Exception e) {
            mensagem = "Erro: " + e;
        }

        out.println("<script type='text/javascript'>");
        out.println("alert('" + mensagem + "');");
        out.println("location.href='listar_menu.jsp';");
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
        String idMenu = request.getParameter("idMenu");
        String nome = request.getParameter("nome");
        String link = request.getParameter("link");
        String icone = request.getParameter("icone");
        String exibir = request.getParameter("exibir");

        String mensagem = "";

        try {
            Menu m = new Menu();
            if (!idMenu.isEmpty()) {
                m.setIdMenu(Integer.parseInt(idMenu));
            }

            if (nome.equals("") || link.equals("") || exibir.equals("")) {
                mensagem = "Campos Obrigatorios deverão ser preenchidos!";
            } else {
                m.setNome(nome);
                m.setLink(link);
                m.setIcone(icone);
                m.setExibir(Integer.parseInt(exibir));

                MenuDAO mDAO = new MenuDAO();
                if (mDAO.gravar(m)) {
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

    /**
     * Returns a short description of the servlet.
     *
     * @return a String containing servlet description
     */
    @Override
    public String getServletInfo() {
        return "Short description";
    }// </editor-fold>

}
