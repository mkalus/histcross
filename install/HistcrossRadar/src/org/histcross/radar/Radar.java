/**
 * Core class - applet and application
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 */
package org.histcross.radar;

import java.applet.Applet;
import java.awt.*;
import java.awt.event.WindowAdapter;
import java.awt.event.WindowEvent;

/**
 * @author mkalus
 *
 */
public class Radar extends Applet {
	/**
	 * 
	 */
	private static final long serialVersionUID = -4729287106976591271L;

	/**
	 * Init applet
	 */
	public void init() {
		System.out.println("histcross Radar Applet."); //$NON-NLS-1$
		setLayout(null);
		resize(RadarSettings.frameWidth, RadarSettings.frameHeight);

		//get applet parameters
		String siteUrl = null;
		int vertexId = -1;
		try {
			siteUrl = getParameter("siteurl"); //$NON-NLS-1$
			vertexId = Integer.parseInt(getParameter("id")); //$NON-NLS-1$
			//set language, if applicable
			String lang = getParameter("lang");
			if (lang != null) Messages.setLanguage(lang);
		} catch (Exception e) {}
		System.out.println("Parameters loaded. Proceeding."); //$NON-NLS-1$

		RadarPanel radarPanel =
			new RadarPanel(RadarSettings.frameWidth, RadarSettings.frameHeight,
					siteUrl, vertexId);
		radarPanel.setAppRef(this);
		add(radarPanel);
		System.out.println("Done. Enjoy the Program."); //$NON-NLS-1$
	}

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		System.out.println("histcross Radar application."); //$NON-NLS-1$

		//Check parameters
		if (args.length != 2) {
			System.err.println(Messages.getString("CMLErr1")); //$NON-NLS-1$
			System.exit(1);
		}

		//retrieve parameters
		String siteUrl = args[0];
		int vertexId = 1;
		try {
			vertexId = Integer.parseInt(args[1]);
		} catch (NumberFormatException e) {
			System.err.println(Messages.getString("CMLErr2")); //$NON-NLS-1$
			System.exit(2);
		}
		System.out.println("Parameters look correct. Proceeding."); //$NON-NLS-1$

		//create frame
		Frame frame = new Frame();
		
		//initial graphics stuff
		frame.setTitle(Messages.getString("Title")); //$NON-NLS-1$
		frame.setSize(RadarSettings.frameWidth, RadarSettings.frameHeight);
		
		// Add a window listener to the frame for shutting
		// down the application.
		frame.addWindowListener(new WindowAdapter() {
			public void windowClosing(WindowEvent e) {
				System.exit(0);
			}
		});
		
		// Center Frame on Screen
		Dimension dim = frame.getToolkit().getScreenSize();
		Rectangle abounds = frame.getBounds();
		frame.setLocation((dim.width - abounds.width) / 2,
				(dim.height - abounds.height) / 2);

		// Show the frame.
		frame.setVisible(true);
		frame.requestFocus();
		System.out.println("Created Frame correctly. Now adding frame."); //$NON-NLS-1$

		//add the panel
		Panel radarPanel =
			new RadarPanel(RadarSettings.frameWidth, RadarSettings.frameHeight,
					siteUrl, vertexId);
		frame.add(radarPanel);
		System.out.println("Done. Enjoy the Program."); //$NON-NLS-1$
	}

}
