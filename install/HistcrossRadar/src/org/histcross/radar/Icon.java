/**
 * Icon Data
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 */
package org.histcross.radar;

import java.applet.*;
import java.awt.*;
import java.io.*;
import java.net.URL;

/** A class to display an image on a canvas */
/**
 * @author mkalus
 *
 */
class Icon extends Canvas {
	/**
	 * 
	 */
	private static final long serialVersionUID = -2553892194473427175L;
	
	/**
	 * Image data
	 */
	protected Image image;
	
	/**
	 * @param c
	 *            parent container
	 * @param file
	 *            file or URL
	 * @throws Exception
	 */
	public Icon(Container c, String file) throws Exception {
		System.out.print("Loading Icon: " + file + "...");
		System.out.flush();
		do {
			if (c instanceof Applet) {
				Applet a = (Applet) c;
				image = a.getImage(a.getCodeBase(), file);
			} else
				image = getToolkit().getImage(new URL(file));

			MediaTracker track = new MediaTracker(this);
			track.addImage(image, 1);
			track.waitForID(1);
			if (track.isErrorID(1))
				break;
			System.out.println("done");
			System.out.flush();
			return;
		} while ((c = c.getParent()) != null);
		throw new FileNotFoundException(file);
	}

	/**
	 * Paint method
	 * 
	 * @param g
	 * @param x
	 * @param y
	 */
	public void paint(Graphics g, int x, int y) {
		Dimension d = getSize();
		g.drawImage(image, x, y, d.width, d.height,
				RadarSettings.frameBackgroundcolor, this);
	}

	/**
	 * return image
	 * 
	 * @return
	 */
	public Image getImage() {
		return image;
	}

	/**
	 * Returns adjusted dimenstions to center the icon
	 * 
	 * @param x
	 * @return
	 */
	public int getAdjustedX(int x) {
		return x - image.getWidth(this) / 2;
	}

	/**
	 * Returns adjusted dimenstions to center the icon
	 * 
	 * @param y
	 * @return
	 */
	public int getAdjustedY(int y) {
		return y - image.getHeight(this) / 2;
	}
	
	/* (non-Javadoc)
	 * @see java.awt.Component#getWidth()
	 */
	public int getWidth() {
		return image.getWidth(this);
	}
	
	/* (non-Javadoc)
	 * @see java.awt.Component#getHeight()
	 */
	public int getHeight() {
		return image.getHeight(this);
	}
}
