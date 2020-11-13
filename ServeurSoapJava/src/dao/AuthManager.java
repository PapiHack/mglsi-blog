package dao;

import domaine.Auth;

public class AuthManager extends Database
{
	
	public int add(Auth auth)
	{
		try 
		{
			int i = new UserManager().getAll().size();
			this.statement = this.getConnexion().prepareStatement("INSERT INTO Auth (idUser, login, mdp) VALUES (?,?,?)");
			this.statement.setInt(1, i);
			this.statement.setString(2, auth.getLogin());
			this.statement.setString(3, auth.getMdp());
			
			return this.statement.executeUpdate();
		} catch (Exception e) {
			e.printStackTrace();
		}
		return 0;
	}
	
	public Auth getAuth(Auth auth)
	{
		Auth a = new Auth();
		try {
			this.statement = this.getConnexion().prepareStatement("SELECT * FROM Auth WHERE login = ? AND mdp = ?");
			this.statement.setString(1, auth.getLogin());
			this.statement.setString(2, auth.getMdp());
			this.result = this.statement.executeQuery();
			
			while(this.result.next())
			{
				a.setIdUser(this.result.getInt("idUser"));
				a.setLogin(this.result.getString("login"));
				a.setMdp(this.result.getString("mdp"));
			}
			
			
		} catch (Exception e) {
			e.printStackTrace();
		}
		return a;
	}
	
	public int remove(int idUser)
	{
		try {
			this.statement = this.getConnexion().prepareStatement("DELETE FROM Auth WHERE idUser = ?");
			this.statement.setInt(1, idUser);
			return this.statement.executeUpdate();
		} catch (Exception e) {
			e.printStackTrace();
		}
		return 0;
	}
	
	public int update(Auth auth)
	{
		try {
			this.statement = this.getConnexion().prepareStatement("UPDATE Auth SET login = ? , mdp = ? WHERE id = ?");
			this.statement.setString(1, auth.getLogin());
			this.statement.setString(2, auth.getMdp());
			this.statement.setInt(3, auth.getId());
			
			return this.statement.executeUpdate();
		} catch (Exception e) {
			e.printStackTrace();
		}
		return 0;
	}

}
