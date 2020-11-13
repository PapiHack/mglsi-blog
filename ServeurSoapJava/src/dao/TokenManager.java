package dao;

import java.util.ArrayList;

import domaine.Token;

public class TokenManager extends Database
{
	public int add(Token token)
	{
		try 
		{
			this.statement = this.getConnexion().prepareStatement("INSERT INTO Token (idUser,token) VALUES(?,?)");
			this.statement.setInt(1, token.getIdUser());
			this.statement.setString(2, token.getToken());
			
			return this.statement.executeUpdate();
			
		} catch (Exception e) {
			e.printStackTrace();
			
		}
		return 0;
	}
	
	public ArrayList<Token> getAll()
	{
		ArrayList<Token> liste = new ArrayList<Token>();
		Token token;
		try 
		{
			this.statement = this.getConnexion().prepareStatement("SELECT * FROM Token");
			this.result = this.statement.executeQuery();
			
			while(this.result.next())
			{
				token = new Token();
				token.setId(this.result.getInt("id"));
				token.setIdUser(this.result.getInt("idUser"));
				token.setToken(this.result.getString("token"));
				liste.add(token);
			}
		} catch (Exception e) {
			e.printStackTrace();
		}
		return liste;
	}
	
	public Token getByToken(String tok)
	{
		Token token = new Token();
		try 
		{
			this.statement = this.getConnexion().prepareStatement("SELECT * FROM Token WHERE token = ?");
			this.statement.setString(1, tok);
			this.result = this.statement.executeQuery();
			
			while(this.result.next())
			{
				token.setId(this.result.getInt("id"));
				token.setIdUser(this.result.getInt("idUser"));
				token.setToken(this.result.getString("token"));
			}
			
		} catch (Exception e) {
			e.printStackTrace();
		}
		return token;
	}
	
	public int revoke(String tok)
	{
		try 
		{
			this.statement = this.getConnexion().prepareStatement("DELETE FROM Token WHERE token = ?");
			this.statement.setString(1, tok);
			return this.statement.executeUpdate();
			
		} catch (Exception e) {
			e.printStackTrace();
		}
		return 0;
	}

}
