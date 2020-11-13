package service;

import java.security.NoSuchAlgorithmException;

import javax.jws.WebMethod;
import javax.jws.WebParam;
import javax.jws.WebService;

import dao.AuthManager;
import dao.TokenManager;
import dao.UserManager;
import domaine.Auth;
import domaine.Token;
import domaine.User;
import utilities.TokenGenerator;

@WebService(serviceName = "ServiceGestionDesUtilisateurs")
public class MySoapService 
{
	private UserManager userDao = new UserManager();
	private AuthManager authDao = new AuthManager();
	private TokenManager tokenDao = new TokenManager();
	
	@WebMethod
	public Token connect(@WebParam(name = "login") String login,@WebParam(name = "password") String mdp) throws NoSuchAlgorithmException
	{
		Token token = new Token();
		Auth auth = new Auth();
		auth.setLogin(login);
		auth.setMdp(mdp);
		Auth authenficated = authDao.getAuth(auth);
		if(authenficated.getIdUser() != 0)
		{
			token.setToken(new TokenGenerator().getToken());
			token.setIdUser(authenficated.getIdUser());
			this.tokenDao.add(token);
		}
		
		return token;
	}
	
	@WebMethod
	public String revokeToken(@WebParam(name = "token")String token)
	{
		Token tok = this.tokenDao.getByToken(token);
		if( tok.getIdUser() != 0)
		{
			int response = this.tokenDao.revoke(token); 
			if(response != 0)
			{
				return "Token supprimé avec succès";
			}
			return "Erreur lors de la suppression du token";
		}
		return "Votre token n'est pas valable";
	}
	
	@WebMethod
	public String addUser(@WebParam(name = "utilisateur")User user,@WebParam(name = "pseudoEtPassword")Auth auth,@WebParam(name = "token")String token)
	{
		Token tok = this.tokenDao.getByToken(token);
		if( tok.getIdUser() != 0)
		{
			int repAddU = this.userDao.add(user);
			
			int repaddAu = this.authDao.add(auth);
			System.out.println(repAddU+'_'+repAddU);
			if((repAddU != 0) && (repaddAu != 0))
			{
				return "Ajout effectué avec succès";
			}
			return "Erreur lors de l'ajout";
		}
		return "Vous n'êtes pas admin";
	}
	
	@WebMethod
	public String updateUser(@WebParam(name = "utilisateur")User user,@WebParam(name = "pseudoEtPassword")Auth auth,@WebParam(name = "token")String token)
	{
		Token tok = this.tokenDao.getByToken(token);
		if( tok.getIdUser() != 0)
		{
			int repAddU = this.userDao.update(user);
			int repaddAu = this.authDao.update(auth);
			if((repAddU != 0) && (repaddAu != 0))
			{
				return "Mise à jour effectué avec succès";
			}
			return "Erreur lors de la mise à jour";
		}
		return "Vous n'êtes pas admin";
	}
	
	@WebMethod
	public String removeUser(@WebParam(name = "idUtilisateur")int id,@WebParam(name = "token")String token)
	{
		Token tok = this.tokenDao.getByToken(token);
		if( tok.getIdUser() != 0)
		{
			int repAddU = this.userDao.remove(id);
			int repaddAu = this.authDao.remove(id);
			if((repAddU != 0) && (repaddAu != 0))
			{
				return "Suppression effectué avec succès";
			}
			return "Erreur lors de la suppression";
		}
		return "Vous n'êtes pas admin";
	}

}
