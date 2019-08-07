package domaine;

import javax.xml.bind.annotation.XmlRootElement;

@XmlRootElement
public class Token 
{
	private int id;
	private int idUser;
	private String token;
	
	
	public Token() {}
	
	public Token(int id,int idUser,String token)
	{
		this.id = id;
		this.idUser = idUser;
		this.token = token;
		
	}

	public int getId() {
		return id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public int getIdUser() {
		return idUser;
	}

	public void setIdUser(int idUser) {
		this.idUser = idUser;
	}

	public String getToken() {
		return token;
	}

	public void setToken(String token) {
		this.token = token;
	}
	
}
