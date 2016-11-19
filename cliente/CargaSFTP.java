import com.jcraft.jsch.ChannelSftp;
import com.jcraft.jsch.JSch;
import com.jcraft.jsch.JSchException;
import com.jcraft.jsch.Session;
import com.jcraft.jsch.SftpException;
import com.jcraft.jsch.UserInfo;
 
public class CargaSFTP {
    private static final String user = "cristian"; //usuario del ordenador 
 private static final String host = "localhost";  //direccion ip
 private static final Integer port = 22;  //puerto 
 private static final String pass = "daniela12";//clave del ordenador 
 
    public void enviar() throws SftpException, JSchException{
        System.out.println("------------------- INICIO");
 
        JSch jsch = new JSch();
        Session session = jsch.getSession(user, host, port);
        UserInfo ui = new SUserInfo(pass, null);
 
        session.setUserInfo(ui);
        session.setPassword(pass);
        session.connect();
 
        ChannelSftp sftp = (ChannelSftp)session.openChannel("sftp");
        sftp.connect();
 
        sftp.cd("/home/cristian/Escritorio/carpeta");//ruta donde va a llegar el archivo
        System.out.println("Subiendo........");
        sftp.put("/home/cristian/operativos/operativos2/operativos2/plo/prueba.json", "prueba.json");//ubicacion y archivo que se va a enviar 
 
        System.out.println("Archivos subidos.");
 
        sftp.exit();
        sftp.disconnect();
        session.disconnect();
 
        System.out.println("----------------- FIN");
    }
}
