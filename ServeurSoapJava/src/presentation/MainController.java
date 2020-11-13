package presentation;

import java.net.URL;
import java.util.ResourceBundle;

import javax.xml.ws.Endpoint;

import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.TextArea;
import service.MySoapService;

public class MainController implements Initializable
{
    @FXML
    private TextArea log;

	@Override
	public void initialize(URL location, ResourceBundle resources) {
		String url = "http://localhost:1234/";
		Endpoint.publish(url, new MySoapService());
		log.appendText("\nServeur à l'écoute à l'adresse " + url);
		
	}

}

