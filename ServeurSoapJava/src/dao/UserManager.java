package dao;

import java.util.ArrayList;

import domaine.User;

public class UserManager extends Database
{
	public int add(User user)
	{
		try {
			this.statement = this.getConnexion().prepareStatement("INSERT INTO User(nom,prenom,mail,statut) VALUES(?,?,?,?)");
			this.statement.setString(1, user.getNom());
			this.statement.setString(2, user.getPrenom());
			this.statement.setString(3, user.getMail());
			this.statement.setString(4, user.getStatut());
			
			return this.statement.executeUpdate();
			
		} catch (Exception e) {
			System.out.println(e.getMessage());
		}
		
		return 0;
		
	}
	
	public ArrayList<User> getAll()
	{
		ArrayList<User> liste = new ArrayList<User>();
		User user;
		try {
			this.statement = this.getConnexion().prepareStatement("SELECT * FROM User");
			this.result = this.statement.executeQuery();
			while (this.result.next()) {
				user = new User();
				user.setId(this.result.getInt("id"));
				user.setMail(this.result.getString("mail"));
				user.setNom(this.result.getString("nom"));
				user.setPrenom(this.result.getString("prenom"));
				user.setStatut(this.result.getString("statut"));
				liste.add(user);
			}
		} catch (Exception e) {
			System.out.println(e.getMessage());
		}
		
		return liste;
	}
	
	public User getById(int id)
	{
		User user = new User();
		try 
		{
			this.statement = this.getConnexion().prepareStatement("SELECT * FROM User WHERE id = ?");
			this.statement.setInt(1, id);
			this.result = this.statement.executeQuery();
			while(this.result.next())
			{
				user.setId(this.result.getInt("id"));
				user.setNom(this.result.getString("nom"));
				user.setPrenom(this.result.getString("prenom"));
				user.setMail(this.result.getString("mail"));
				user.setStatut(this.result.getString("statut"));
			}
			
		} 
		catch (Exception e) 
		{
			e.printStackTrace();
		}
		return user;
	}
	
	public int update(User user)
	{
		try 
		{
			this.statement = this.getConnexion().prepareStatement("UPDATE User SET nom = ? , prenom = ? , mail = ? , statut = ? WHERE id = ?");
			this.statement.setString(1, user.getNom());
			this.statement.setString(2, user.getPrenom());
			this.statement.setString(3, user.getMail());
			this.statement.setString(4, user.getStatut());
			this.statement.setInt(5, user.getId());
			return this.statement.executeUpdate();
		} 
		catch (Exception e) 
		{
			e.printStackTrace();
		}
		return 0;
	}
	
	public int remove(int id)
	{
		try 
		{
			this.statement = this.getConnexion().prepareStatement("DELETE FROM User WHERE id = ? ");
			this.statement.setInt(1, id);
			return this.statement.executeUpdate();
		} catch (Exception e) {
			e.printStackTrace();
		}
		return 0;
		
	}

}
