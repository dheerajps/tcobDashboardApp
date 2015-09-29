-- TABLE STRUCTURES

-- Stores the groups
CREATE TABLE dashboard_groups(
	group_id VARCHAR(30) PRIMARY KEY,
	-- Current list:
	--	acct
	--	adm
	--	adv
	--	busCarServ
	--	crosby
	--	dev
	--	execComm
	--	execMba
	--	finance
	--	gradProg
	--	market
	--	mgmt
	--	phd
	--	profDev
	--	stAbroad
	--	ugProg
	group_name VARCHAR(50) NOT NULL
	-- Elaborates on the ID. e.g., busCarServ = Business Career Services
);

-- Stores the URLs
CREATE TABLE dashboard_urls (
	url_name VARCHAR(75) PRIMARY KEY, -- Page Title, e.g., Advising Dashboard or Business Metrics Dashboard or etc
	url_address VARCHAR(MAX) NOT NULL, -- Hyperlink
	section_id VARCHAR(50) NULL, -- To which section does this URL belong (i.e., There are TOPICS (e.g., Strategic Initiative) with SECTIONS under them)
	topic_id VARCHAR(50) NULL, -- Topic it belongs to 
	FOREIGN KEY(section_id) REFERENCES dashboard_topics,
	FOREIGN KEY(topic_id) REFERENCES dashboard_topics
);

-- Handles many to many relationship between dashboard_groups and dashboard_urls
CREATE TABLE dashboard_urls_by_group(
	url_name VARCHAR(75) NOT NULL, -- See dashboard_urls
	group_id VARCHAR(30) NOT NULL, -- see dashboard_groups
	FOREIGN KEY (url_name) REFERENCES dashboard_urls,
	FOREIGN KEY (group_id) REFERENCES dashboard_groups
);


CREATE TABLE dashboard_sections(
section_id VARCHAR(50) PRIMARY KEY, 
--	a unique section id
section_name VARCHAR(50) NOT NULL
-- not sure about the names the sections can get so it has section1 section2, section3...
);

CREATE TABLE dashboard_topics(
topic_id VARCHAR(50) PRIMARY KEY, 
--	a unique id for each topic
topic_name VARCHAR(50) NOT NULL
-- not sure about the names the sections can get so it has section1 section2, section3...
);




