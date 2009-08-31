/**
 * Double buffered Panel to draw network
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 */
package org.histcross.radar;

import java.applet.Applet;
import java.awt.*;
import java.awt.event.KeyEvent;
import java.awt.event.KeyListener;
import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;
import java.awt.event.MouseMotionListener;
import java.awt.geom.Line2D;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.HashMap;

import org.histcross.radar.BareBonesBrowserLaunch;

/**
 * @author mkalus
 *
 */
public class RadarPanel extends Panel implements MouseMotionListener, MouseListener, KeyListener {
	/**
	 * 
	 */
	private static final long serialVersionUID = -7465307432738171464L;

	/**
	 * Id to show
	 */
	private int vertexId = -1;
	
	/**
	 * URL of site
	 */
	private String siteUrl = ""; //$NON-NLS-1$
	
	/**
	 * The vertex container
	 */
	private VertexContainer vertexContainer = null;

	/**
	 * Application status
	 */
	private int appStatus = RadarSettings.APP_LOADING;

	/**
	 * double buffer elements
	 */
	// The object we will use to write with instead of the standard screen graphics
    Graphics bufferGraphics;
    // The image that will contain everything that has been drawn on
    // bufferGraphics.
    Image offscreen;
    
    private boolean initialized = false; //data has been loaded?
    private Font rFont, bFont;

    private boolean showInfo = true; //show initial info text?
    
    //applet reference, if any
    private Applet appRef = null;
    
    /**
     * Images Map that holds the images
     */
    HashMap<String, Icon> icons;
    
    /**
     * status elements
     */
    int x, y; //mouse coordinates
    boolean mouseDown = false; //mouseButton pressed?
    Vertex inVertex = null; //over Vertex?
    Relation inRelation = null; //over relation?

	/**
	 * Constructor
	 * @param width width of panel
	 * @param height height of panel
	 * @param siteUrl base site url of histcross instance, e.g. http://hc.site.org/
	 * @param id initial id
	 */
	public RadarPanel(int width, int height, String siteUrl, int id) {
		System.out.println("Initializing radar panel."); //$NON-NLS-1$
		//set graphics basics
		setSize(width, height);
		setBackground(RadarSettings.frameBackgroundcolor);
		
		//Listeners
		addMouseMotionListener(this);
		addMouseListener(this);
		addKeyListener(this);
		setFocusable(true);
		
		//correct siteURL, if needed
		if (siteUrl != null &&
				siteUrl.charAt(siteUrl.length()-1) != '/') siteUrl += '/';
		//set initial data
		this.siteUrl = siteUrl;
		this.vertexId = id;
		
		//load fonts
		try {
			rFont = Font.createFont(Font.TRUETYPE_FONT,
					this.getClass().getResourceAsStream("LiberationSans-Regular.ttf")).deriveFont(14f); //$NON-NLS-1$
		} catch (Exception e) {
			e.printStackTrace();
			System.out.println("Regular font could not be loaded!"); //$NON-NLS-1$
			rFont = new Font("SansSerif", Font.PLAIN, 12); //$NON-NLS-1$
		}
		
		try {
			bFont = Font.createFont(Font.TRUETYPE_FONT,
					this.getClass().getResourceAsStream("LiberationSans-Bold.ttf")).deriveFont(14f); //$NON-NLS-1$
		} catch (Exception e) {
			e.printStackTrace();
			System.out.println("Bold font could not be loaded!"); //$NON-NLS-1$
			bFont = new Font("SansSerif", Font.BOLD, 12); //$NON-NLS-1$
		}
		
		//initialize container and iconMap
		vertexContainer = new VertexContainer();
		icons = new HashMap<String, Icon>();
		System.out.println("Initializing radar panel: Done."); //$NON-NLS-1$
	}
	
	/**
	 * Sets the applet reference (needed by Radar applet)
	 * @param appRef the appRef to set
	 */
	public void setAppRef(Applet appRef) {
		this.appRef = appRef;
	}

	/**
	 * Loads the data from the web and calculates positions
	 */
	public void loadData() {
		//load initial data from internet and calculate positions
		appStatus = vertexContainer.loadData(siteUrl, vertexId);
		if (appStatus != RadarSettings.APP_OK) {
			repaint();
			return;
		}
		//Calculate position of data and load images
		calculatePositions();
    }
	
	/**
	 * Calculate position of data and load images
	 */
	public void calculatePositions() {
		System.out.println("Loading vertexContainer returned: " + appStatus + "."); //$NON-NLS-1$ //$NON-NLS-2$
		vertexContainer.calculatePositions(getWidth(), getHeight());
		System.out.println("Calulated positions."); //$NON-NLS-1$
		
		//load images and set vertex dimensions
    	for (int i = 0; i < vertexContainer.fastVertices.length; i++) {
    		Vertex v = vertexContainer.fastVertices[i];
    		Icon icon = getIcon((v.isPrintBig()?"b":"s") + v.getPictogram_id() + ".png"); //$NON-NLS-1$ //$NON-NLS-2$ //$NON-NLS-3$
    		int x0 = icon.getAdjustedX(v.getX());
    		int y0 = icon.getAdjustedY(v.getY());
    		v.setDimensions(x0, y0, x0 + icon.getWidth(), y0 + icon.getHeight());
    	}
    	repaint();
	}

	/**
	 * Always required for good double-buffering.
	 * This will cause the applet not to first wipe off
	 * previous drawings but to immediately repaint.
	 * the wiping off also causes flickering.
	 * Update is called automatically when repaint() is called.
	 */
    public void update(Graphics g)
    {
         paint(g);
    }

	/**
	 * Handles all of the drawing
	 */
    public void paint(Graphics g) {
		if (offscreen == null) {
			// Create an offscreen image to draw on
			// Make it the size of the applet, this is just perfect larger
			// size could slow it down unnecessary.
			offscreen = createImage(getWidth(), getWidth());
			// by doing this everything that is drawn by bufferGraphics
			// will be written on the offscreen image.
			bufferGraphics = offscreen.getGraphics();
		}
		
        // Wipe off everything that has been drawn before
        // Otherwise previous drawings would also be displayed.
		bufferGraphics.clearRect(0, 0, getWidth(), getHeight());
        
        //Is there a special applet mode?
        if (appStatus == RadarSettings.APP_OK) paintNetwork();
        else paintError();

    	if (!initialized) {
    		loadData();
    		initialized = true;
    	}

    	g.drawImage(offscreen,0,0,this);
	}

    /**
     * Draws an error string
     */
    public void paintError() {
    	bufferGraphics.setColor(Color.red);
    	bufferGraphics.setFont(bFont);
    	String errMessage;
    	switch (appStatus) {
       	case RadarSettings.APP_LOADING: errMessage = Messages.getString("RadarPanel.LoadingData"); break; //$NON-NLS-1$
    	case RadarSettings.APP_PARMERR: errMessage = Messages.getString("RadarPanel.ParametersError"); break; //$NON-NLS-1$
       	case RadarSettings.APP_XMLERR: errMessage = Messages.getString("RadarPanel.DataError"); break; //$NON-NLS-1$
    	default: errMessage = Messages.getString("RadarPanel.UnknownError"); //$NON-NLS-1$
    	}
    	bufferGraphics.drawString(errMessage,100,100);
    }
    
    /**
     * Core mothod to paint: draws the network
     */
    public void paintNetwork() {
		//convert to 2D graphics
		Graphics2D g2 = (Graphics2D) bufferGraphics;
		g2.setRenderingHint(RenderingHints.KEY_ANTIALIASING, RenderingHints.VALUE_ANTIALIAS_ON);

		//iterate through relations
    	bufferGraphics.setColor(RadarSettings.relationColor);
    	for (int i = 0; i < vertexContainer.fastRelations.length; i++) {
    		Relation r = vertexContainer.fastRelations[i];
    		if (r.getFromVertex().getX() != -1 && r.getToVertex().getX() != -1) {
    			bufferGraphics.drawLine(r.getFromVertex().getX(),
    					r.getFromVertex().getY(), r.getToVertex().getX(),
    					r.getToVertex().getY());
    		}
    	}
    	
    	//iterate through vertices
    	for (int i = 0; i < vertexContainer.fastVertices.length; i++) {
    		Vertex v = vertexContainer.fastVertices[i];
    		if (v.getX() != -1) {
    			Icon icon = getIcon((v.isPrintBig()?"b":"s") + v.getPictogram_id() + ".png"); //$NON-NLS-1$ //$NON-NLS-2$ //$NON-NLS-3$
    			if (icon == null) //fallback
    				bufferGraphics.drawRect(v.getX()-8, v.getY()-8, 16, 16);
    			else bufferGraphics.drawImage(icon.image, icon.getAdjustedX(v.getX()), icon.getAdjustedY(v.getY()), icon.getWidth(), icon.getHeight(), RadarSettings.frameBackgroundcolor, this);
    		}
    	}
    	
    	//is the mouse pointer over a vertex?
    	if (inVertex != null && mouseDown == false) paintVertexPopup(g2);
    	else if (inRelation != null && mouseDown == false) paintRelationPopup(g2);

    	//show initial info text?
    	if (showInfo) paintInfoText(g2);
    	else {
    		g2.setFont(rFont);
    		g2.setColor(Color.RED);
    		String helpText = Messages.getString("RadarPanel.hForHelp"); //$NON-NLS-1$
    		int lineWidth = (int) rFont.getStringBounds(helpText, g2.getFontRenderContext()).getWidth();
    		g2.drawString(helpText, getWidth() - lineWidth - 10, getHeight() - rFont.getSize() - 5); 
    	}
    }
    
    /**
     * Draws a vertex popup
     * @param g2
     */
    public void paintVertexPopup(Graphics2D g2) {
		String fromto = ""; //$NON-NLS-1$
		if (inVertex.getStart().length() > 0) {
			fromto = inVertex.getStart() + "‒"; //$NON-NLS-1$
			if (inVertex.getStop().length() > 0) fromto += inVertex.getStop();
		} else if (inVertex.getStop().length()  > 0)
			fromto = "‒" + inVertex.getStop(); //$NON-NLS-1$
		
		//calculate line width for header
		int firstlineWidth = (int) bFont.getStringBounds(inVertex.getTitle(), g2.getFontRenderContext()).getWidth() + 8;
		
		//now for the rest
		int fromToWidth = (int) rFont.getStringBounds(fromto, g2.getFontRenderContext()).getWidth();
		int typeWidth = (int) rFont.getStringBounds(inVertex.getVertexType(), g2.getFontRenderContext()).getWidth();

		int secondlineWidth = fromToWidth + typeWidth + 30;

		Rectangle rect = new Rectangle(inVertex.getX(), inVertex.getY(), firstlineWidth>secondlineWidth?firstlineWidth:secondlineWidth, bFont.getSize() * 3);
		if (rect.getMaxX() > getWidth())
			rect.x -= rect.getMaxX() - getWidth();
		if (rect.getMaxY() > getHeight())
			rect.y -= rect.getMaxY() - getHeight();
		bufferGraphics.setColor(RadarSettings.roundRectborder);
		bufferGraphics.drawRoundRect(rect.x - 2, rect.y - 2, rect.width + 4, rect.height + 4, 15, 15);
		bufferGraphics.setColor(RadarSettings.roundRectfill);
		bufferGraphics.fillRoundRect(rect.x, rect.y, rect.width, rect.height, 15, 15);
		bufferGraphics.setColor(RadarSettings.infoTextHead);
		g2.setFont(bFont);
		g2.drawString(inVertex.getTitle(), rect.x + 4, rect.y + bFont.getSize() + 1);
		g2.setFont(rFont);
		g2.drawString(inVertex.getVertexType(), rect.x + 4, (int) (rect.y + rFont.getSize()*2.4 + 1));
		g2.drawString(fromto, rect.x + 24 + typeWidth, (int) (rect.y + rFont.getSize()*2.4 + 1));
		
		//disable info text
		showInfo = false;
    }
    
    public void paintRelationPopup(Graphics2D g2) {
		String fromto = ""; //$NON-NLS-1$
		if (inRelation.getStart().length() > 0) {
			fromto = inRelation.getStart() + "‒"; //$NON-NLS-1$
			if (inRelation.getStop().length() > 0) fromto += inRelation.getStop();
		} else if (inRelation.getStop().length()  > 0)
			fromto = "‒" + inRelation.getStop(); //$NON-NLS-1$
   	
		String title = inRelation.getFromVertex().getTitle() + "→" + //$NON-NLS-1$
			inRelation.getTitle() + "→" + //$NON-NLS-1$
			inRelation.getToVertex().getTitle();
		
		//calculate widths
		int titleWidth = (int) rFont.getStringBounds(title, g2.getFontRenderContext()).getWidth();
		int fromToWidth = (int) rFont.getStringBounds(fromto, g2.getFontRenderContext()).getWidth();
		
		int width = (titleWidth>fromToWidth?titleWidth:fromToWidth) + 8;
		int height = (int) (rFont.getSize()*2.4) + 8;
		if (fromto.length() == 0)
			height = (int) rFont.getSize() + 8;
		
		int x0 = inRelation.getFromVertex().getX();
		int y0 = inRelation.getFromVertex().getY();
		int x1 = inRelation.getToVertex().getX();
		int y1 = inRelation.getToVertex().getY();
		
		//sort
		if (x0 < x1) { int m = x0; x0 = x1; x1 = m; }
		if (y0 < y1) { int m = y0; y0 = y1; y1 = m; }
		
		int x = x1 + (x0 - x1)/2 - width/2;
		int y = y1 + (y0 - y1)/2 - height/2;

		bufferGraphics.setColor(RadarSettings.roundRectRborder);
		bufferGraphics.drawRoundRect(x - 2, y - 2, width + 4, height + 4, 15, 15);
		bufferGraphics.setColor(RadarSettings.roundRectRfill);
		bufferGraphics.fillRoundRect(x, y, width, height, 15, 15);
		bufferGraphics.setColor(RadarSettings.infoTextRHead);
		g2.setFont(rFont);
		g2.drawString(title, x + 4, y + rFont.getSize() + 1);
		g2.drawString(fromto, x + 4, y + (int) (rFont.getSize() * 2.4) + 1);
		
		//disable info text
		showInfo = false;
    }
    
    /**
     * Paints an initial info-text at the lower left corner
     * @param g2
     */
    public void paintInfoText(Graphics2D g2) {
    	//Info-Text
    	String[] line = {
    			Messages.getString("RadarPanel.Info1"), //$NON-NLS-1$
    			Messages.getString("RadarPanel.Info2"), //$NON-NLS-1$
    			Messages.getString("RadarPanel.Info3"), //$NON-NLS-1$
    			Messages.getString("RadarPanel.Info4"), //$NON-NLS-1$
    			Messages.getString("RadarPanel.Info5"), //$NON-NLS-1$
    			Messages.getString("RadarPanel.Info6"), //$NON-NLS-1$
    			Messages.getString("RadarPanel.Info7") //$NON-NLS-1$
    	};
    	
    	//calculate maximum width
    	int max = 0;
    	for (int i = 0; i < line.length; i++) {
    		int lineWidth;
    		if (i == 0) lineWidth = (int) bFont.getStringBounds(line[i], g2.getFontRenderContext()).getWidth();
    		else lineWidth = (int) rFont.getStringBounds(line[i], g2.getFontRenderContext()).getWidth(); 
    		if (lineWidth > max) max = lineWidth;
    	}
    	
    	//set box
    	int x0 = 15;
    	int y0 = getHeight() - line.length * rFont.getSize() - 51;
    	int x1 = max + 8;
    	int y1 = (int) (line.length * rFont.getSize() * 1.3) + 8;
		bufferGraphics.setColor(RadarSettings.infoBoxRectborder);
		bufferGraphics.drawRoundRect(x0 - 2, y0 - 2, x1 + 4, y1 + 4, 15, 15);
		bufferGraphics.setColor(RadarSettings.infoBoxRectfill);
		bufferGraphics.fillRoundRect(x0, y0, x1, y1, 15, 15);
		bufferGraphics.setColor(RadarSettings.infoBoxTextHead);
		
		//draw lines
		for (int i = 0; i < line.length; i++) {
    		if (i == 0) g2.setFont(bFont);
    		else g2.setFont(rFont);
    		
    		g2.drawString(line[i], x0 + 4, y0 + bFont.getSize() + 4 + (int) (i * bFont.getSize() * 1.3));
		}
    }
    
    /**
     * Returns an icon image or null
     * loads the icon, if not already in the iconMap
     * @param iconKey
     * @return
     */
    public Icon getIcon(String iconKey) {
    	//icon lookup
    	Icon icon = icons.get(iconKey);
    	if (icon == null) { //no icon found: load it
    		try {
				//fetch new icon
    			icon = new Icon(this, siteUrl + "img/pictograms/" + iconKey); //$NON-NLS-1$
    			//add to iconMap
				icons.put(iconKey, icon);
			} catch (Exception e) {
				System.out.println("Icon " + siteUrl + "img/pictograms/" + iconKey + " not loaded!"); //$NON-NLS-1$ //$NON-NLS-2$ //$NON-NLS-3$
			}
    	}
    	//return icon
    	return icon;
    }

    /**
	 * null out the offscreen buffer as part of invalidation
	 */
	public void invalidate() {
		super.invalidate();
		offscreen = null;
		bufferGraphics = null;
	}

	public void mouseDragged(MouseEvent e) {
		if (inVertex != null) {
			inVertex.setXY(e.getX(), e.getY());
    		Icon icon = getIcon((inVertex.isPrintBig()?"b":"s") + inVertex.getPictogram_id() + ".png"); //$NON-NLS-1$ //$NON-NLS-2$ //$NON-NLS-3$
    		int x0 = icon.getAdjustedX(inVertex.getX());
    		int y0 = icon.getAdjustedY(inVertex.getY());
    		inVertex.setDimensions(x0, y0, x0 + icon.getWidth(), y0 + icon.getHeight());
		}
		repaint();
	}

	public void mouseMoved(MouseEvent e) {
		if (vertexContainer.fastVertices == null) return;
    	//set stuff
		inVertex = null;
		inRelation = null;
		x = e.getX();
		y = e.getY();
		//test, if pointer is within a vertex
    	for (int i = 0; i < vertexContainer.fastVertices.length; i++) {
    		Vertex v = vertexContainer.fastVertices[i];
    		
    		if (v.withinVertex(x, y)) {
    			inVertex = v;
    			if (appRef != null) {
    				appRef.getAppletContext().showStatus(Messages.getString("RadarPanel.StatusInfo")); //$NON-NLS-1$
    			}
    			break;
    		}
		}
    	
    	//now text, if the mouse is somewhere near a line
    	if (inVertex == null) //only if not in a vertex!
	    	for (int i = 0; i < vertexContainer.fastRelations.length; i++) {
	    		Relation r = vertexContainer.fastRelations[i];
	    		double dist = Line2D.ptLineDist(r.getFromVertex().getX(), r.getFromVertex().getY(),
	    				r.getToVertex().getX(), r.getToVertex().getY(), x, y);
	    		if (dist <= 4) {
	    			inRelation = r;
	    			break;
	    		}
	    	}
    		
    	repaint();
	}

	public void mouseClicked(MouseEvent e) {
		//react to all kinds of different events:
		if (e.getClickCount() == 2 && inVertex != null) {
			//catch double clicks: load new output
			//old output is wiped
			appStatus = RadarSettings.APP_LOADING; //set app loading
			//force showing the loading screen
			Graphics g = getGraphics();
			if (g != null) {
				update(g);
				g.dispose();
			}
			
			//set new root vertex
			vertexId = inVertex.getId();
			//reload all data, wipe old
			loadData();
		} else if (inVertex != null && e.isShiftDown()) {
			//only in applet mode, on vertex and shift-clicking
			//load vertex page in browser
			try {
				if (appRef != null)
					appRef.getAppletContext().showDocument(new URL(siteUrl + "vertices/view/" + inVertex.getId() + "/viewnetworkapplet:yes#visualized_network")); //$NON-NLS-1$
				else //attempt open in browser - also open visualized network and jump to it in browser
					BareBonesBrowserLaunch.openURL(siteUrl + "vertices/view/" + inVertex.getId() + "/viewnetworkapplet:yes#visualized_network"); //$NON-NLS-1$
			} catch (MalformedURLException e1) {}
			
		} else if (inVertex != null && e.isControlDown()) {
			//klicking and pushing Ctrl:
			//add new node data to model - old data is retained
			appStatus = RadarSettings.APP_LOADING; //set app loading
			//force showing the loading screen
			Graphics g = getGraphics();
			if (g != null) {
				update(g);
				g.dispose();
			}
			//load new data from web and add it to the model
			appStatus = vertexContainer.addData(siteUrl, inVertex.getId());
			//Calculate position of data and load images
			calculatePositions();
			//repaint
			repaint();
		} else if (inVertex != null && e.isAltGraphDown()) {
			//klicking and pushing AltGr
			//Delete selected node
			System.out.println("Delete " + inVertex.getTitle()); //$NON-NLS-1$
			//clear relations to this vertex
			for (int i = 0; i < vertexContainer.fastRelations.length; i++) {
				Relation r = vertexContainer.fastRelations[i];
				if (r.getFromVertex() == inVertex ||
						r.getToVertex() == inVertex)
					vertexContainer.relations.remove(new Integer(r.getId()));
			}
			//clear the vertex itself
			vertexContainer.vertices.remove(new Integer(inVertex.getId()));
			//recreate fast access
			vertexContainer.createFastAccess();
			repaint();
		}
	}

	public void mouseEntered(MouseEvent e) {
		requestFocus(); //to have the keyListener work properly
	}

	public void mouseExited(MouseEvent e) {}

	public void mousePressed(MouseEvent e) {
		mouseDown = true;
		showInfo = false; //delete info Text
		repaint();
	}

	public void mouseReleased(MouseEvent e) {
		mouseDown = false;
		repaint();
	}

	public void keyPressed(KeyEvent e) {}

	public void keyReleased(KeyEvent e) {}

	public void keyTyped(KeyEvent e) {
		if (e.getKeyChar() == 'h') {
			if (showInfo) showInfo = false;
			else showInfo = true;
			repaint();
			requestFocus();
		}
	}
}
