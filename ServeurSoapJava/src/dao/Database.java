package dao;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;

public class Database {
	
	private Connection connexion;
	protected PreparedStatement statement;
	protected ResultSet result;

	public Database() {
		this.statement = null;
		this.result = null;
		
		try {
			Class.forName("com.mysql.jdbc.Driver");
			this.connexion = DriverManager.getConnection("jdbc:mysql://localhost:3306/mglsi_news", "alioune","alioune1996");
		} catch (Exception e) {
			System.out.println(e.getMessage());
		}
	}

	public Connection getConnexion() {
		return connexion;
	}

}
