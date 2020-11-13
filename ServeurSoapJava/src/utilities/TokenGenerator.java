package utilities;

import java.util.ArrayList;

import dao.TokenManager;
import domaine.Token;

public class TokenGenerator 
{
	private static final String ALPHA_NUMERIC_STRING = "azertyuiopqsdfghjklmwxcvbn-_@ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	private ArrayList<Token> allTokens;
	
	public TokenGenerator() {
		TokenManager dao = new TokenManager();
		this.allTokens = dao.getAll();
	}
	
	private boolean exist(String tok)
	{
		for(Token token : allTokens)
		{
			if(token.getToken().equals(tok))
			{
				return true;
			}
		}
		return false;
	}

	private String randomAlphaNumeric() {

	StringBuilder builder = new StringBuilder();
	int count = (int) (Math.random()*(ALPHA_NUMERIC_STRING.length() - 10) + 1);

	while (count-- != 0) {

	int character = (int)(Math.random()*ALPHA_NUMERIC_STRING.length());

	builder.append(ALPHA_NUMERIC_STRING.charAt(character));

	}

	return builder.toString();

	}
	
	public String getToken()
	{
		String token = "";
		do {
			token = this.randomAlphaNumeric();
		} while (exist(token));
		return token;
	}

}
