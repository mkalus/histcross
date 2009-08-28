/**
 * Holds the information on vertices and relations
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 */
package org.histcross.radar;

import java.io.*;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.HashMap;
import java.util.Iterator;
import java.util.LinkedList;

/**
 * @author mkalus
 * 
 */
public class VertexContainer {
	/**
	 * HashMaps for Vertices and Relations
	 */
	HashMap<Integer, Vertex> vertices;
	HashMap<Integer, Relation> relations;

	/**
	 * faster iterations
	 */
	Vertex[] fastVertices;
	Relation[] fastRelations;

	/**
	 * Data structure for vertices
	 */
	Vertex rootVertex;
	LinkedList<Vertex> secondLevelVertices;

	/**
	 * Loads the data
	 * 
	 * @param baseUrl
	 *            siteURL e.g. http://www.histcross.org/
	 * @param id
	 *            to retreive
	 * @return Status codes for the Radar class
	 */
	public int loadData(String baseUrl, int id) {
		//applet no parameter given
		if (id == -1) return RadarSettings.APP_PARMERR;

		//initialize hash maps
		rootVertex = null;
		vertices = new HashMap<Integer, Vertex>();
		relations = new HashMap<Integer, Relation>();
		secondLevelVertices = new LinkedList<Vertex>();
		
		//add actual data
		return addData(baseUrl, id);
	}

	/**
	 * Load data without deleting old elements - good for adding
	 * additional nodes.
	 * 
	 * @param baseUrl
	 * @param id
	 * @return
	 */
	public int addData(String baseUrl, int id) {
		//get file from web
		URL url; 

		try {
			url = new URL(baseUrl + "vertices/netplain/" + id);
		} catch (MalformedURLException e) {
			System.err.println("URL malformed!");
			return RadarSettings.APP_XMLERR;
		}
		
		//open connection
		try {
			BufferedReader in = new BufferedReader(
					new InputStreamReader(url.openStream()));
			String inputLine;
			
			//traverse through data
			while ((inputLine = in.readLine()) != null) {
			      if (inputLine.equals("+++VERTEX+++")) {
			    	  Vertex v = addVertex(in);
			    	  if (v == null) return RadarSettings.APP_XMLERR;
			      } else if (inputLine.equals("+++RELATION+++")) {
			    	  //Relation r = addRelation(in);
			    	  //if (r == null) return RadarSettings.APP_XMLERR;
			    	  addRelation(in);
			      } else if (inputLine.equals("+++END+++")) //end of line
			    	  break;
			      else {
			    	  System.err.println("Unknown line: " + inputLine);
			    	  throw new Exception();
			      }
			}

			in.close();
		} catch (Exception e) {
			System.err.println("I/O error!");
			return RadarSettings.APP_XMLERR;
		}

		//now create fast access
		createFastAccess();
		
		return RadarSettings.APP_OK; //everything ok
	}
	
	/**
	 * Creates a fast access field that makes live easier
	 */
	public void createFastAccess() {
		fastVertices = new Vertex[vertices.size()];
		int i = 0;
		Iterator<Integer> it = vertices.keySet().iterator();
    	while (it.hasNext()) {
    		Integer key = it.next();
    		Vertex v = vertices.get(key);
    		fastVertices[i++] = v;
    	}
		fastRelations = new Relation[relations.size()];
		i = 0;
		it = relations.keySet().iterator();
    	while (it.hasNext()) {
    		Integer key = it.next();
    		Relation r = relations.get(key);
    		fastRelations[i++] = r;
    	}
	}

	/**
	 * Add a vertex to the list or return an already existing one
	 * 
	 * @param in Buffered stream
	 * @return created or retrieved vertex
	 */
	public Vertex addVertex(BufferedReader in) {
		try {
			Vertex v;
			//retrive element attributes
			String[] line = new String[6];
			for (int i = 0; i < 6; i++) {
				line[i] = in.readLine().trim();
			}
			
			//retreive id
			int id = Integer.parseInt(line[0]);
			
			//check for existing vertex in list
			v = vertices.get(new Integer(id));
			//yes, already there - return this key
			if (v != null) return v;
			
			//retrive element attributes (cont'd)
			String title = line[1];
			String start = line[2];
			String stop = line[3];
			int pictogram_id = Integer.parseInt(line[4]);
			String vertexType = line[5];
			
			//Create new vertex
			v = new Vertex(id, title, start, stop, pictogram_id, vertexType);
			vertices.put(new Integer(id), v);
			
			//root vertex?
			if (rootVertex == null) rootVertex = v;
			else secondLevelVertices.add(v);

			return v;
		} catch (Exception ex) {
			return null;
		}
	}
	 
	/**
	 * Add a relation to the list or return an already existing one Note: make
	 * shure that the vertices already exist in the data structure!
	 * 
	 * @param in Buffered stream
	 * @return created or retrieved relation
	 */
	public Relation addRelation(BufferedReader in) {
		try {
			Relation r;
			//retrive element attributes
			String[] line = new String[7];
			for (int i = 0; i < 7; i++) {
				line[i] = in.readLine();
			}

			//retreive id
			int id = Integer.parseInt(line[0]);
			
			//check for existing relation in list
			r = relations.get(new Integer(id));
			//yes, already there - return this key
			if (r != null) return r;
			
			//retrive element attributes (cont'd)
			String title = line[3];
			String start = line[5];
			String stop = line[6];
			int pictogram_id = Integer.parseInt(line[4]);
			
			Vertex fromVertex = vertices.get(new Integer(Integer.parseInt(line[1])));
			Vertex toVertex = vertices.get(new Integer(Integer.parseInt(line[2])));
			if (fromVertex == null || toVertex == null) throw new Exception();
			
			//Create new relation
			r = new Relation(id, fromVertex, toVertex, title, start, stop, pictogram_id);
			relations.put(new Integer(id), r);

			return r;
		} catch (Exception ex) {
			return null;
		}
	}

	/**
	 * Calculate the positions of the elements on a plane
	 * 
	 * @param width
	 *            in pixels
	 * @param height
	 *            in pixels
	 */
	public void calculatePositions(int width, int height) {
		if (rootVertex == null)
			return;

		// first calculate position of center element - easy...
		rootVertex.setXY(width / 2, height / 2);

		// first calculate the positions of the second and third level
		// elements
		double elements = secondLevelVertices.size();
		double grade = 2 * Math.PI / elements;
		double x0 = rootVertex.getX();
		double y0 = rootVertex.getY();
		double radius = RadarSettings.radius1;
		int i = 0;
		Iterator<Vertex> it = secondLevelVertices.iterator();
		while (it.hasNext()) {
			Vertex v = it.next();
			double x = x0 + radius * Math.cos(i * grade);
			double y = y0 + radius * Math.sin(i++ * grade);
			v.setXY((int) x, (int) y);
		}
	}

	/**
	 * Test method
	 * 
	 * @param args
	 */
	public static void main(String[] args) {
		VertexContainer v = new VertexContainer();
		v.loadData("http://histcross/", 354);
	}

}
