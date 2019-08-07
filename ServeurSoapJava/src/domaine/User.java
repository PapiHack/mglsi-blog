package domaine;

import javax.xml.bind.annotation.XmlRootElement;

@XmlRootElement
public class User 
{
	private int id;
	private String nom;
	private String prenom;
	private String mail;
	private String statut;
	
	public User() {}
	
	public User(int id, String nom, String prenom, String mail, String statut) {
		this.id = id;
		this.nom = nom;
		this.prenom = prenom;
		this.mail = mail;
		this.statut = statut;
	}
	
	public User(User user)
	{
		this(user.getId(),user.getNom(),user.getPrenom(),user.getMail(),user.getStatut());
	}

	public int getId() {
		return id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public String getNom() {
		return nom;
	}

	public void setNom(String nom) {
		this.nom = nom;
	}

	public String getPrenom() {
		return prenom;
	}

	public void setPrenom(String prenom) {
		this.prenom = prenom;
	}

	public String getMail() {
		return mail;
	}

	public void setMail(String mail) {
		this.mail = mail;
	}

	public String getStatut() {
		return statut;
	}

	public void setStatut(String statut) {
		this.statut = statut;
	}
	
	
	
}
